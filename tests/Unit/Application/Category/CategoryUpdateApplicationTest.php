<?php declare(strict_types = 1);

use Core\Application\Category\DataTransfer\{CategoryUpdateInput};
use Core\Application\Category\{CategoryUpdateApplication};
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('Category Update Application Unit Test', function () {
    it('should update entity when is active is enable', function () {
        $mockEntity = $this->mockCategoryEntity();
        $mockEntity->shouldReceive('enable')->once();

        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('show')
            ->withArgs(['id'])
            ->andReturn($mockEntity)
            ->once();
        $repository->shouldReceive('update')
            ->andReturn($mockEntity)
            ->once();

        $mockInput = mock(CategoryUpdateInput::class, ['id', 'name', 'description', true]);

        $application = new CategoryUpdateApplication(repository: $repository);
        $application->handle($mockInput);
    });

    it('should update entity when is active is disable', function () {
        $mockEntity = $this->mockCategoryEntity();
        $mockEntity->shouldReceive('disable')->once();

        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('show')
            ->withArgs(['id'])
            ->andReturn($mockEntity)
            ->once();
        $repository->shouldReceive('update')
            ->andReturn($mockEntity)
            ->once();

        $mockInput = mock(CategoryUpdateInput::class, ['id', 'name', 'description', false]);

        $application = new CategoryUpdateApplication(repository: $repository);
        $application->handle($mockInput);
    });
});