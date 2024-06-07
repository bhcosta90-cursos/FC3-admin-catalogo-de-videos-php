<?php

declare(strict_types = 1);

use Core\Domain\Entity\Traits\MethodMagicTrait;
use Core\Domain\Object\Id;

describe('Method Magic Trait Unit Test', function () {
    test('must be return exception when method not exists', function () {
        $methodMagicTrait = new class () {
            use MethodMagicTrait;

            protected string $name = 'testing';

            protected ?DateTime $createdAt = null;

            public ?Id $id = null;
        };

        expect(fn () => $methodMagicTrait->description)->toThrow(\Exception::class)
            ->and($methodMagicTrait)->name->toBe('testing')
            ->id()->not->toBeNull()
            ->id->toBeInstanceOf(Id::class)
            ->createdAt()->toBeString()->not->toBeNull()
            ->createdAt->toBeInstanceOf(DateTime::class);
    });
});
