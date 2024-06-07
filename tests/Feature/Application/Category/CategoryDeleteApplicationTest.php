<?php

use App\Models\Category;
use Core\Application\Category\CategoryDeleteApplication;
use Core\Domain\Repository\CategoryRepositoryInterface;

use function PHPUnit\Framework\assertInstanceOf;

describe('CategoryDeleteApplication Feature Test', function(){
    test("delete a entity", function(){
        $entity = Category::factory()->create();

        $application = new CategoryDeleteApplication(
            repository: app(CategoryRepositoryInterface::class)
        );

        $response = $application->handle($entity->id);
        expect($response)->toBeTruthy();
    });
});
