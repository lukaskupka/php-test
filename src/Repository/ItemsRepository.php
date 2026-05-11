<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\Item;

use function random_int;

readonly class ItemsRepository
{
    public function __construct(private int $fakeProductCount)
    {
    }

    /**
     * Creates fake products
     *
     * @return array<Item>
     */
    public function fakeLoadItems(): array
    {
        /* create fake data */
        $products = [];

        for ($i = 1; $i <= $this->fakeProductCount; $i++) {
            $products[] = new Item(
                'Product #' . str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                random_int(100, 999) * 100,
            );
        }

        return $products;
    }
}
