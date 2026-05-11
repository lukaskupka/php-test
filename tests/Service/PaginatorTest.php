<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Dto\Item;
use App\Service\Paginator;
use PHPUnit\Framework\TestCase;

class PaginatorTest extends TestCase
{
    private Paginator $paginator;
    private int $defaultPageSize = 10;
    private int $mobilePageSize = 5;

    public function testPaginationDesktop(): void
    {
        $items = $this->createItems(25);
        $this->paginator->init($items, 1, false);

        $this->assertCount(10, $this->paginator->getPagedItems());
        $this->assertEquals(1, $this->paginator->getCurrentPage());
        $this->assertEquals(3, $this->paginator->getTotalPages());
        $this->assertFalse($this->paginator->hasPreviousPage());
        $this->assertTrue($this->paginator->hasNextPage());

        $this->paginator->init($items, 2, false);
        $this->assertCount(10, $this->paginator->getPagedItems());
        $this->assertEquals(2, $this->paginator->getCurrentPage());
        $this->assertTrue($this->paginator->hasPreviousPage());
        $this->assertTrue($this->paginator->hasNextPage());

        $this->paginator->init($items, 3, false);
        $this->assertCount(5, $this->paginator->getPagedItems());
        $this->assertEquals(3, $this->paginator->getCurrentPage());
        $this->assertTrue($this->paginator->hasPreviousPage());
        $this->assertFalse($this->paginator->hasNextPage());
    }

    public function testPaginationMobile(): void
    {
        $items = $this->createItems(12);
        $this->paginator->init($items, 1, true);

        $this->assertCount(5, $this->paginator->getPagedItems());
        $this->assertEquals(3, $this->paginator->getTotalPages());

        $this->paginator->init($items, 3, true);
        $this->assertCount(2, $this->paginator->getPagedItems());
    }

    public function testEmptyItems(): void
    {
        $this->paginator->init([], 1, false);

        $this->assertCount(0, $this->paginator->getPagedItems());
        $this->assertEquals(1, $this->paginator->getCurrentPage());
        $this->assertEquals(1, $this->paginator->getTotalPages());
        $this->assertFalse($this->paginator->hasPreviousPage());
        $this->assertFalse($this->paginator->hasNextPage());
    }

    public function testSinglePage(): void
    {
        $items = $this->createItems(10);
        $this->paginator->init($items, 1, false);

        $this->assertCount(10, $this->paginator->getPagedItems());
        $this->assertEquals(1, $this->paginator->getTotalPages());
        $this->assertFalse($this->paginator->hasPreviousPage());
        $this->assertFalse($this->paginator->hasNextPage());
    }

    protected function setUp(): void
    {
        $this->paginator = new Paginator($this->defaultPageSize, $this->mobilePageSize);
    }

    /** @return array<Item> */
    private function createItems(int $count): array
    {
        $items = [];

        for ($i = 1; $i <= $count; $i++) {
            $items[] = new Item("Test item $i", $i * 100);
        }

        return $items;
    }
}
