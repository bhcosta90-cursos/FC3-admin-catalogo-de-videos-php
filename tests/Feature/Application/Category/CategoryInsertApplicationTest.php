<?php

use Core\Application\Category\CategoryInsertApplication;
use Core\Application\Category\DataTransfer\CategoryInsertInput;
use Core\Application\Category\DataTransfer\CategoryOutput;
use Core\Domain\Repository\CategoryRepositoryInterface;

use function PHPUnit\Framework\assertInstanceOf;

describe('CategoryInsertApplication Feature Test', function(){
    test("create a new entity", function(){
        $application = new CategoryInsertApplication(
            repository: app(CategoryRepositoryInterface::class)
        );

        $response = $application->handle(new CategoryInsertInput(name: 'Category Test', description: 'Description Test'));
        expect($response)->toBeInstanceOf(CategoryOutput::class)
            ->name->toBe('Category Test')
            ->description->toBe('Description Test')
            ->id->not->toBeNull()
            ->created_at->not->toBeNull();
    });
});
