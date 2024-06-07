<?php

declare(strict_types=1);

namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function insert(Category $category): Category;

    public function findById(string $id): Category;

    public function findAll(?string $filter = null, ?string $order = 'ASC');

    public function paginate(?string $filter = null, ?string $order = 'ASC', int $page = 1, $limit = 10): array;

    public function update(Category $category): Category;

    public function delete(string $id): bool;

    public function toCategory(object $data): Category;
}
