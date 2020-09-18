<?php

declare(strict_types=1);

namespace MSDev\PantoneConverterBundle\Tests;

class PantoneSwatchTest extends TwigBasedTestCase
{
    public function testSwatchGeneratedForValidColour(): void
    {
        self::assertEquals(
            $this->getExpectedResultNoBorder('F6EB61'),
            $this->getTwig()->render('@IntegrationTest/swatch.html.twig', [
                'colour' => '100 C'
            ])
        );
    }

    public function testSwatchGeneratedForValidColourWithContent(): void
    {
        $colour = '100 C';
        self::assertEquals(
            $this->getExpectedResultNoBorder('F6EB61', $colour),
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
            $this->getExpectedResultNoBorder('F6EB61', $content),
            $this->getTwig()->render('@IntegrationTest/swatch-with-content.html.twig', [
                'colour' => '100 C',
                'content' => $content,
            ])
        );
    }

    public function testSwatchGeneratedForInvalidColour(): void
    {
        self::assertEquals(
            $this->getExpectedResultNoBorder('FFFFFF'),
            $this->getTwig()->render('@IntegrationTest/swatch.html.twig', [
                'colour' => 'Foo Bah'
            ])
        );
    }

    public function testSwatchGeneratedForValidColourWithHTMLContentAndRedBorder(): void
    {
        $content = '<strong>100 C</strong>';
        $border = 'red';
        self::assertEquals(
            $this->getExpectedResultRedBorder('F6EB61', $content, $border),
            $this->getTwig()->render('@IntegrationTest/swatch-with-content-bordered.html.twig', [
                'colour' => '100 C',
                'content' => $content,
                'border' => $border
            ])
        );
    }

    public function testSwatchGeneratedForValidColourWithHTMLContentAndBorderWhite(): void
    {
        $content = '<strong>100 C</strong>';
        $border = 'red';
        self::assertEquals(
            $this->getExpectedResultNoBorder('F6EB61', $content),
            $this->getTwig()->render('@IntegrationTest/swatch-with-content-bordered-white.html.twig', [
                'colour' => '100 C',
                'content' => $content,
                'borderWhite' => $border
            ])
        );
    }

    public function testSwatchGeneratedForWhiteWithHTMLContentAndBorderWhite(): void
    {
        $content = '<strong>White</strong>';
        $border = 'red';
        self::assertEquals(
            $this->getExpectedResultRedBorder('FFFFFF', $content, $border),
            $this->getTwig()->render('@IntegrationTest/swatch-with-content-bordered-white.html.twig', [
                'colour' => 'Foo',
                'content' => $content,
                'borderWhite' => $border
            ])
        );
    }


    private function getExpectedResultNoBorder(string $hex, ?string $content = ''): string
    {
        return <<<EOHTML
<span class="pantone-swatch" style="background-color:#{$hex};">{$content}</span>
EOHTML;
    }

    private function getExpectedResultRedBorder(string $hex, string $content, string $border)
    {
        return <<<EOHTML
<span class="pantone-swatch" style="background-color:#{$hex};border-color:{$border}">{$content}</span>
EOHTML;
    }
}
