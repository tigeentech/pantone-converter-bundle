<?php

declare(strict_types=1);

namespace MSdev\PantoneConverterBundle\Twig\Extension;

use MSDev\PantoneConverter\Exception\ColourNotFound;
use MSDev\PantoneConverter\PantoneConverter;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PantoneSwatch extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('pantone_swatch', [$this, 'pantoneSwatch'], [
                'is_safe' => ['html'],
                'needs_environment' => true,
            ]),
        ];
    }

    public function pantoneSwatch(Environment $environment, string $colourName, ?string $content = null): string
    {
        try {
            $colour = PantoneConverter::ColourFromName($colourName);
            $hex = $colour->hex();
        } catch (ColourNotFound $except) {
            $hex = 'FFFFFF';
        }

        return $environment->render(
            '@PantoneConverter/swatch.html.twig', [
            'colour' => $hex,
            'content' => $content
        ]);
    }
}
