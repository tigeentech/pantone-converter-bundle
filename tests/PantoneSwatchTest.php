<?php

declare(strict_types=1);

namespace MSDev\PantoneConverterBundle\Tests;

use MSDev\PantoneConverterBundle\Tests\TwigBasedTestCase;

class PantoneSwatchTest extends TwigBasedTestCase
{
    public function testSwatchGeneratedForValidColour(): void
    {
        self::assertEquals(
            $this->getExpectedResult('F6EB61'),
            $this->getTwig()->render('@IntegrationTest/swatch.html.twig', [
                'colour' => '100 C'
            ])
        );
    }

    public function testSwatchGeneratedForValidColourWithContent(): void
    {
        $colour = '100 C';
        self::assertEquals(
            $this->getExpectedResult('F6EB61', $colour),
            $this->getTwig()->render('@IntegrationTest/swatch-with-content.html.twig', [
                'colour' => $colour,
                'content' => $colour,
            ])
        );
    }

    public function testSwatchGeneratedForValidColourWithHTMLContent(): void
    {
        $content = '<strong>100 C</strong>';
        self::assertEquals(
            $this->getExpectedResult('F6EB61', $content),
            $this->getTwig()->render('@IntegrationTest/swatch-with-content.html.twig', [
                'colour' => '100 C',
                'content' => $content,
            ])
        );
    }

    public function testSwatchGeneratedForInvalidColour(): void
    {
        self::assertEquals(
            $this->getExpectedResult('FFFFFF'),
            $this->getTwig()->render('@IntegrationTest/swatch.html.twig', [
                'colour' => 'Foo Bah'
            ])
        );
    }

    private function getExpectedResult(string $hex, ?string $content = ''): string
    {
        return <<<EOHTML
<span class="pantone-swatch" style="background-color:#{$hex};">{$content}</span>
EOHTML;
    }
}
