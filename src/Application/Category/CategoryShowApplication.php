<?php

declare(strict_types = 1);

namespace Core\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;

readonly class CategoryShowApplication
{
    public function __construct(protected CategoryRepositoryInterface $repository)
    {
    }

    public function handle(DataTransfer\CategoryShowInput $input): DataTransfer\CategoryOutput
    {
        $entityFind = $this->repository->show($input->id);

        return new DataTransfer\CategoryOutput(
            id: $entityFind->id(),
            name: $entityFind->name,
            is_active: $entityFind->isActive,
            description: $entityFind->description,
            created_at: $entityFind->createdAt(),
        );
    }

}