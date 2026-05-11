<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\FakeProductItem;

use function ceil;
use function count;

class Paginator
{
    /** @param array<FakeProductItem> $pagedItems */
    public function __construct(
        readonly private int $defaultPageSize,
        readonly private int $mobilePageSize,
        private array $pagedItems = [],
        private int $currentPage = 1,
        private int $totalPages = 1,
    ) {
    }

    /** @param array<FakeProductItem> $items */
    public function init(array $items, int $currentPage, bool $isMobile = false): void
    {
        $pageSize = $isMobile
            ? $this->mobilePageSize
            : $this->defaultPageSize;
        $this->totalPages = count($items) > 0
            ? (int) ceil(count($items) / $pageSize)
            : 1;
        $this->currentPage = $currentPage;
        $this->pagedItems = array_slice($items, ($currentPage - 1) * $pageSize, $pageSize);
    }

    /** @return array<FakeProductItem> */
    public function getPagedItems(): array
    {
        return $this->pagedItems;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->totalPages;
    }
}
