<?php declare(strict_types = 1);

use Core\Application\Category\CategoryFindByIdApplication;
use Core\Application\Category\CategoryInsertApplication;
use Core\Application\Category\DataTransfer\CategoryFindByIdInput;
use Core\Application\Category\DataTransfer\CategoryInsertInput;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('Category FindById Application Unit Test', function () {
    it('get category', function () {
        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('findById')
            ->withArgs(['id'])
            ->andReturn($this->mockCategory())
            ->once();

        $mockInput = mock(CategoryFindByIdInput::class, ['id']);

        $application = new CategoryFindByIdApplication(repository: $repository);
        $application->handle($mockInput);
    });
});
