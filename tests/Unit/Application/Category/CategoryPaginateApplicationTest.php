<?php declare(strict_types = 1);

use Core\Application\Category\DataTransfer\{CategoriesOutput, CategoryShowInput};
use Core\Application\Category\{CategoryPaginateApplication, CategoryShowApplication};
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('Category Paginate Application Unit Test', function () {
    test('when list is empty', function () {
        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('paginate')
            ->andReturn(mockPagination())
            ->once();

        $application = new CategoryPaginateApplication(repository: $repository);
        $response = $application->handle();

        expect($response)->toBeInstanceOf(CategoriesOutput::class)
            ->items->toHaveCount(0);
    });

    test('when list is not empty', function () {
        $register = new stdClass();
        $register->id = 'id';
        $register->name = 'name';
        $register->description = 'description';
        $register->is_active = 'is_active';
        $register->created_at = 'created_at';
        $register->updated_at = 'created_at';
        $register->deleted_at = 'created_at';

        $mockPagination = mockPagination([
            $register,
        ]);

        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('paginate')
            ->andReturn($mockPagination)
            ->once();

        $application = new CategoryPaginateApplication(repository: $repository);
        $response = $application->handle();

        expect($response)->toBeInstanceOf(CategoriesOutput::class)
            ->items->toHaveCount(1);
    });
});
