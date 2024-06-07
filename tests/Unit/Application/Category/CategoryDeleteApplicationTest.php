<?php

declare(strict_types = 1);

use Core\Application\Category\{CategoryDeleteApplication};
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('CategoryDeleteApplication Unit Test', function () {
    it('should delete category', function () {
        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('delete')
            ->withArgs(['id'])
            ->andReturn(true)
            ->once();

        $application = new CategoryDeleteApplication(repository: $repository);
        $application->handle('id');
    });
});
