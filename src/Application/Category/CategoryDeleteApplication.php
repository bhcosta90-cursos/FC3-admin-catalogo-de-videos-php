<?php

declare(strict_types=1);

namespace Core\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;

readonly class CategoryDeleteApplication
{
    public function __construct(protected CategoryRepositoryInterface $repository)
    {
    }

    public function handle(string $id): bool
    {
        return $this->repository->delete($id);
    }

}
