<?php
declare(strict_types=1);

use Core\Application\Category\CategoryInsertApplication;
use Core\Application\Category\DataTransfer\{CategoryInsertInput, CategoryOutput};
use Core\Domain\Repository\CategoryRepositoryInterface;

describe('CategoryInsertApplication Feature Test', function () {
    test("create a new entity", function () {
        $application = new CategoryInsertApplication(
            repository: app(CategoryRepositoryInterface::class)
        );

        $response = $application->handle(
            new CategoryInsertInput(name: 'Category Test', description: 'Description Test')
        );
        expect($response)->toBeInstanceOf(CategoryOutput::class)
            ->name->toBe('Category Test')
            ->description->toBe('Description Test')
            ->is_active->toBeTrue()
            ->id->not->toBeNull()
            ->created_at->not->toBeNull();
    });
});
