<?php

declare(strict_types=1);

use App\Models\Category;
use Core\Application\Category\CategoryShowApplication;
use Core\Application\Category\DataTransfer\CategoryOutput;
use Core\Domain\Repository\CategoryRepositoryInterface;

describe('CategoryShowApplication Feature Test', function () {
    test("create a new entity", function () {
        $entity = Category::factory()->create();

        $application = new CategoryShowApplication(
            repository: app(CategoryRepositoryInterface::class)
        );

        $response = $application->handle($entity->id);
        expect($response)->toBeInstanceOf(CategoryOutput::class)
            ->name->toBe($entity->name)
            ->description->toBe($entity->description)
            ->id->toBe($entity->id)
            ->created_at->toBe($entity->created_at->format('Y-m-d H:i:s'));
    });
});
