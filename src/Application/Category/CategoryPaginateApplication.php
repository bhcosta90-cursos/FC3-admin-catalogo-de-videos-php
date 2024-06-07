<?php

declare(strict_types = 1);

namespace Core\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;

readonly class CategoryPaginateApplication
{
    public function __construct(protected CategoryRepositoryInterface $repository)
    {
    }

    public function handle(): DataTransfer\CategoriesOutput
    {
        $entityFind = $this->repository->paginate();

        return new DataTransfer\CategoriesOutput(
            items: $entityFind->items(),
            total: $entityFind->total(),
            current_page: $entityFind->currentPage(),
            last_page: $entityFind->lastPage(),
            first_page: $entityFind->firstPage(),
            per_page: $entityFind->perPage(),
            to: $entityFind->to(),
            from: $entityFind->from(),
        );
    }

}
