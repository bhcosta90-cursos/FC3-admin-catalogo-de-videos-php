<?php declare(strict_types = 1);

use Core\Application\Category\{CategoryShowApplication};
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('Category Show Application Unit Test', function () {
    it('should show category', function () {
        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('show')
            ->withArgs(['id'])
            ->andReturn($this->mockCategoryEntity())
            ->once();

        $application = new CategoryShowApplication(repository: $repository);
        $application->handle('id');
    });
});
