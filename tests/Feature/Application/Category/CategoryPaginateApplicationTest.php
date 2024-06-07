<?php

declare(strict_types=1);

use App\Models\Category;
use Core\Application\Category\CategoryPaginateApplication;
use Core\Domain\Repository\CategoryRepositoryInterface;

describe('CategoryPaginateApplication Feature Test', function () {
    test("create a new entity", function () {
        $entity = Category::factory(20)->create();

        $application = new CategoryPaginateApplication(
            repository: app(CategoryRepositoryInterface::class)
        );

        $response = $application->handle();

        expect($response)
            ->total->toBe(20)
            ->items->toHaveCount(10)
            ->last_page->toBe(2)
            ->first_page->toBe(1)
            ->current_page->toBe(1)
            ->per_page->toBe(10)
            ->to->toBe(1)
            ->from->toBe(10);
    });
});
