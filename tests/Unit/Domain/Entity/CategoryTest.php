<?php declare(strict_types = 1);

use Core\Domain\Entity\Category;

use Core\Domain\Entity\Exception\EntityValidationException;

use Core\Domain\Object\Id;

use function PHPUnit\Framework\{assertFalse, assertTrue};

describe('Category Entity Unit Test', function () {
    test("attributes", function () {
        $category = new Category(
            name: 'name entity',
            isActive: true,
            description: 'description entity',
        );

        expect($category)
            ->name->toBe('name entity')
            ->description->toBe('description entity')
            ->isActive->toBeTruthy()
            ->id()->not->toBeNull()
            ->createdAt()->not->toBeNull();
    });

    it("must be active entity", function () {
        $category = new Category(
            name: 'name entity',
            isActive: false,
        );

        assertFalse($category->isActive);
        $category->enable();
        assertTrue($category->isActive);
    });

    test("must be disabled entity", function () {
        $category = new Category(
            name: 'name entity',
            isActive: true,
        );

        assertTrue($category->isActive);
        $category->disable();
        assertFalse($category->isActive);
    });

    test('update entity', function () {
        $id = Id::random();

        $category = new Category(
            name: 'name entity',
            isActive: true,
            description: 'description entity',
            id: $id,
        );

        $category->update(
            name: 'update name entity',
            description: 'update description entity'
        );

        expect($category)
            ->name->toBe('update name entity')
            ->description->toBe('update description entity')
            ->id->toBe($id);

        $category->update(
            name: 'update name entity',
            description: null
        );

        expect($category)
            ->description->toBeNull();
    });

    test('must see exception when name there is two characters', function () {
        $category = new Category(
            name: 'name entity'
        );

        expect(fn () => new Category(name: 'na', isActive: true))
            ->toThrow(new EntityValidationException('The value must be at least 3 characters'))
            ->and(fn () => $category->update(name: str_repeat('a', 256), description: 'description entity'))
            ->toThrow(new EntityValidationException('The value must not be greater than 255 characters'))
            ->and(fn () => $category->update(name: 'na', description: 'description entity'))
            ->toThrow(new EntityValidationException('The value must be at least 3 characters'))
            ->and(fn () => $category->update(name: str_repeat('a', 256), description: 'description entity'))
            ->toThrow(new EntityValidationException('The value must not be greater than 255 characters'));
    });

    test('must see exception when description there is two characters', function () {
        $category = new Category(
            name: 'name entity',
            description: 'description entity'
        );

        expect(fn () => new Category(name: 'name entity', description: 'na'))
            ->toThrow(new EntityValidationException('The value must be at least 3 characters'))
            ->and(fn () => $category->update(name: 'name entity', description: str_repeat('n', 256)))
            ->toThrow(new EntityValidationException('The value must not be greater than 255 characters'))
            ->and(fn () => $category->update(name: 'name entity', description: 'na'))
            ->toThrow(new EntityValidationException('The value must be at least 3 characters'))
            ->and(fn () => $category->update(name: 'name entity', description: str_repeat('n', 256)))
            ->toThrow(new EntityValidationException('The value must not be greater than 255 characters'));
    });
});
