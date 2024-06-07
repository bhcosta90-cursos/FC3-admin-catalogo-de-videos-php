<?php declare(strict_types = 1);

use Core\Application\Category\DataTransfer\{CategoryShowInput};
use Core\Application\Category\{CategoryShowApplication};
use Core\Domain\Repository\CategoryRepositoryInterface;
use Tests\Unit\Application\Traits\CategoryRepositoryInterfaceTrait;

uses(CategoryRepositoryInterfaceTrait::class);

describe('Category FindById Application Unit Test', function () {
    it('get category', function () {
        $repository = mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('show')
            ->withArgs(['id'])
            ->andReturn($this->mockCategory())
            ->once();

        $mockInput = mock(CategoryShowInput::class, ['id']);

        $application = new CategoryShowApplication(repository: $repository);
        $application->handle($mockInput);
    });
});
