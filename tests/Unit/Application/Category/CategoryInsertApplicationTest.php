<?php declare(strict_types = 1);

use Core\Application\Category\CategoryInsertApplication;
use Core\Application\Category\DataTransfer\CategoryInsertInput;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('Category Insert Application Unit Test', function () {
    it('create a new category', function () {
        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('insert')
            ->andReturn($this->mockCategory())
            ->once();

        $mockInput = mock(CategoryInsertInput::class, ['name', 'description']);

        $application = new CategoryInsertApplication(repository: $repository);
        $application->handle($mockInput);
    });
});
