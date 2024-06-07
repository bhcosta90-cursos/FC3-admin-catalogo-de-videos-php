<?php

declare(strict_types=1);

namespace Core\Application\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;

readonly class CategoryInsertApplication
{
    public function __construct(protected CategoryRepositoryInterface $repository)
    {
    }

    public function handle(DataTransfer\CategoryInsertInput $input): DataTransfer\CategoryOutput
    {
        $entity = new Category(
            name: $input->name,
            description: $input->description,
        );

        $entityCreated = $this->repository->insert($entity);

        return new DataTransfer\CategoryOutput(
            id: $entityCreated->id(),
            name: $entityCreated->name,
            is_active: $entityCreated->isActive,
            description: $entityCreated->description,
            created_at: $entityCreated->createdAt(),
        );
    }

}
