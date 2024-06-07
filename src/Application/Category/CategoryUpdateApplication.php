<?php

declare(strict_types = 1);

namespace Core\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;

readonly class CategoryUpdateApplication
{
    public function __construct(protected CategoryRepositoryInterface $repository)
    {
    }

    public function handle(DataTransfer\CategoryUpdateInput $input): DataTransfer\CategoryOutput
    {
        $entityFind = $this->repository->show($input->id);
        $input->isActive ? $entityFind->enable() : $entityFind->disable();
        $entityUpdate = $this->repository->update($entityFind);

        return new DataTransfer\CategoryOutput(
            id: $entityUpdate->id(),
            name: $entityUpdate->name,
            is_active: $entityUpdate->isActive,
            description: $entityUpdate->description,
            created_at: $entityUpdate->createdAt(),
        );
    }

}
