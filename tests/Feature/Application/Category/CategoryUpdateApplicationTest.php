<?php
declare(strict_types=1);

use App\Models\Category;
use Core\Application\Category\CategoryUpdateApplication;
use Core\Application\Category\DataTransfer\CategoryOutput;
use Core\Application\Category\DataTransfer\CategoryUpdateInput;
use Core\Domain\Repository\CategoryRepositoryInterface;

describe('CategoryUpdateApplication Feature Test', function () {
    test("create a new entity", function () {
        $entity = Category::factory()->create(['is_active' => true]);

        $application = new CategoryUpdateApplication(
            repository: app(CategoryRepositoryInterface::class)
        );

        $response = $application->handle(new CategoryUpdateInput(
            id: $entity->id,
            name: 'category 1 updated',
            description: 'description 1 updated',
            isActive: false
        ));

        expect($response)->toBeInstanceOf(CategoryOutput::class)
            ->name->toBe('category 1 updated')
            ->description->toBe('description 1 updated')
            ->is_active->toBeFalse()
            ->id->toBe($entity->id)
            ->created_at->toBe($entity->created_at->format('Y-m-d H:i:s'));
    });
});
