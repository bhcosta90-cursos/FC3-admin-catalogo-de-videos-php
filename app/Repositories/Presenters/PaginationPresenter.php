<?php

declare(strict_types=1);

namespace App\Repositories\Presenters;

use Core\Application\Contract\PaginationInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class PaginationPresenter implements PaginationInterface
{
    /**
     * @return stdClass[]
     */
    protected array $items = [];

    protected function __construct(
        protected LengthAwarePaginator $paginator
    ) {
        $this->items = $this->resolveItems(
            items: $this->paginator->items()
        );
    }

    protected function resolveItems(array $items): array
    {
        $response = [];

        foreach ($items as $item) {
            $stdClass = new stdClass();

            foreach ($item->toArray() as $key => $value) {
                $stdClass->{$key} = $value;
            }

            $response[] = $stdClass;
        }

        return $response;
    }

    /**
     * @return stdClass[]
     */
    public function items(): array
    {
        return $this->items;
    }

    public static function make(LengthAwarePaginator $paginator): self
    {
        return new self($paginator);
    }

    public function total(): int
    {
        return $this->paginator->total();
    }

    public function lastPage(): int
    {
        return $this->paginator->lastPage();
    }

    public function firstPage(): int
    {
        return $this->paginator->firstItem() ?? 0;
    }

    public function currentPage(): int
    {
        return $this->paginator->currentPage();
    }

    public function perPage(): int
    {
        return $this->paginator->perPage();
    }

    public function to(): int
    {
        return $this->paginator->firstItem() ?? 0;
    }

    public function from(): int
    {
        return $this->paginator->lastItem() ?? 0;
    }
}
