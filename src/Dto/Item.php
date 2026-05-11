<?php

declare(strict_types=1);

namespace App\Dto;

readonly class Item
{
    public function __construct(private string $name, private int $priceCents)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPriceCents(): int
    {
        return $this->priceCents;
    }
}
