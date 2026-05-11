<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\FakeProductEntity;
use function random_int;

class FakeProductRepository
{
    private const FAKE_PRODUCT_COUNT = 237;

    /**
     * Creates fake products
     *
     * @return FakeProductEntity[]
     */
    public function loadCollection(): array
    {
        /* create fake data */
        $products = [];
        for ($i = 1; $i <= self::FAKE_PRODUCT_COUNT; $i++) {
            $products[] = new FakeProductEntity(
                'Product #' . str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                random_int(100, 999) * 100 + random_int(1, 99),
            );
        }

        return $products;
    }
}
