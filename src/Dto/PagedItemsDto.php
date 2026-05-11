<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\FakeProductEntity;

readonly class PagedItemsDto
{
    public function __construct(
        private array $getPagedItems,
        private int $getCurrentPage,
        private int $getTotalPages,
        private bool $hasPreviousPage,
        private bool $hasNextPage,
    ) {
    }

    /** @return FakeProductEntity[] */
    public function getGetPagedItems(): array
    {
        return $this->getPagedItems;
    }

    public function getGetCurrentPage(): int
    {
        return $this->getCurrentPage;
    }

    public function getGetTotalPages(): int
    {
        return $this->getTotalPages;
    }

    public function isHasPreviousPage(): bool
    {
        return $this->hasPreviousPage;
    }

    public function isHasNextPage(): bool
    {
        return $this->hasNextPage;
    }
}
