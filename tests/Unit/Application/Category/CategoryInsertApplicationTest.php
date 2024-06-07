<?php

declare(strict_types = 1);

use Core\Application\Category\CategoryInsertApplication;
use Core\Application\Category\DataTransfer\CategoryInsertInput;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('CategoryInsertApplication Unit Test', function () {
    it('should a create a new category', function () {
        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('insert')
            ->andReturn($this->mockCategoryEntity())
            ->once();

        $mockInput = mock(CategoryInsertInput::class, ['name', 'description']);

        $application = new CategoryInsertApplication(repository: $repository);
        $application->handle($mockInput);
    });
});
