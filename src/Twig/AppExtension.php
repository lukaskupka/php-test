<?php

declare(strict_types=1);

namespace App\Twig;

use NumberFormatter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    /** @return array<TwigFilter> */
    public function getFilters(): array
    {
        return [
            new TwigFilter('czk', $this->formatCzk(...)),
        ];
    }

    public function formatCzk(int $amount): string|false
    {
        $formatter = new NumberFormatter('cs_CZ', NumberFormatter::CURRENCY);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

        return $formatter->formatCurrency($amount, 'CZK');
    }
}
