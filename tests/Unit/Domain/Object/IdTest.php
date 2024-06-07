<?php declare(strict_types = 1);

use Core\Domain\Object\Id;

use function PHPUnit\Framework\assertTrue;

use Ramsey\Uuid\Uuid;

describe("Uuid Unit Test", function () {
    test("create a validate id", function () {
        $id = new Id("123e4567-e89b-12d3-a456-426614174000");
        assertTrue(Uuid::isValid((string) $id));
    });

    test('create a random id', function () {
        $id = Id::random();
        assertTrue(Uuid::isValid((string) $id));
    });

    test('create a invalid id', function () {
        expect(function () {
            new Id("123e4567-e89b-12d3-a456-42661417400");
        })->toThrow(InvalidArgumentException::class);
    });
});
