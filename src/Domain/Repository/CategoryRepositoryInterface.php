<?php

declare(strict_types = 1);

namespace Core\Domain\Repository;

use Core\Application\Contract\PaginationInterface;
use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function insert(Category $category): Category;

    public function show(string $id): Category;

    public function paginate(
        string $filter = null,
        ?string $order = 'ASC',
        int $page = 1,
        int $limit = 10
    ): PaginationInterface;

    public function update(Category $category): Category;

    public function delete(string $id): bool;
}
