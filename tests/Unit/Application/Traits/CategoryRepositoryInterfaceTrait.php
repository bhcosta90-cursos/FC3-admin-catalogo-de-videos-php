<?php

declare(strict_types = 1);

namespace Tests\Unit\Application\Traits;

use Core\Domain\Entity\Category;
use DateTime;
use Mockery\MockInterface;

trait CategoryRepositoryInterfaceTrait
{
    public function mockCategoryEntity(string $name = null, string $description = null): MockInterface|Category
    {
        $mock = mock(Category::class, [
            $name ?: 'mock name',
            $description ?: 'mock description',
        ]);

        $mock->shouldReceive('id')->andReturn('f0912d11-09f2-4778-9379-ae44e216c933')->once();
        $mock->shouldReceive('createdAt')->andReturn((new DateTime())->format('Y-m-d H:i:s'))->once();

        return $mock;
    }
}
