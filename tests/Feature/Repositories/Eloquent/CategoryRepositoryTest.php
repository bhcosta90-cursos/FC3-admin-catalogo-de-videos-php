<?php declare(strict_types = 1);

use App\Models\Category as CategoryModel;
use App\Repositories\Eloquent\CategoryRepository;
use Core\Domain\Entity\Category;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas, assertSoftDeleted};

describe("Category Repository Feature Test", function () {
    beforeEach(function () {
        $this->repository = app(CategoryRepository::class);
    });

    it("should create a new entity", function () {
        $response = $this->repository->insert(new Category(name: "Category 1", description: "Description 1"));

        expect($response)
            ->id->not->toBeNull()
            ->createdAt->not->toBeNull()
            ->name->toBe("Category 1")
            ->description->toBe("Description 1")
            ->isActive->toBeTrue();

        assertDatabaseCount(CategoryModel::class, 1);
        assertDatabaseHas(CategoryModel::class, [
            'id'          => $response->id,
            'name'        => 'Category 1',
            'description' => 'Description 1',
            'is_active'   => true,
            'created_at'  => $response->createdAt,
        ]);
    });

    it('should find a entity', function () {
        $model = CategoryModel::factory()->create();

        $response = $this->repository->show($model->id);

        expect($response)
            ->id()->toBe($model->id)
            ->createdAt()->toBe($model->created_at->format('Y-m-d H:i:s'))
            ->name->toBe($model->name)
            ->description->toBe($model->description)
            ->isActive->toBe($model->is_active);
    });

    it('should paginate a entities', function () {
        CategoryModel::factory(15)->create(['name' => 'Category 2']);
        CategoryModel::factory(5)->create(['name' => 'Category 1']);

        $response = $this->repository->paginate();
        $items    = collect($response->items());

        expect($response)
            ->total()->toBe(20)
            ->items()->toHaveCount(10)
            ->lastPage()->toBe(2)
            ->firstPage()->toBe(1)
            ->currentPage()->toBe(1)
            ->perPage()->toBe(10)
            ->to()->toBe(1)
            ->from()->toBe(10)
            ->and($items)->first()->name->toBe('Category 1')
            ->last()->name->toBe('Category 2');

        $response = $this->repository->paginate(filter: 'Category 1');
        expect($response)
            ->total()->toBe(5)
            ->items()->toHaveCount(5)
            ->lastPage()->toBe(1)
            ->firstPage()->toBe(1)
            ->currentPage()->toBe(1)
            ->perPage()->toBe(10)
            ->to()->toBe(1)
            ->from()->toBe(5);

        $response = $this->repository->paginate(page: 2);
        expect($response)
            ->total()->toBe(20)
            ->items()->toHaveCount(10)
            ->lastPage()->toBe(2)
            ->firstPage()->toBe(11)
            ->currentPage()->toBe(2)
            ->perPage()->toBe(10)
            ->to()->toBe(11)
            ->from()->toBe(20);

        $response = $this->repository->paginate(limit: 5);
        expect($response)
            ->total()->toBe(20)
            ->items()->toHaveCount(5)
            ->lastPage()->toBe(4)
            ->firstPage()->toBe(1)
            ->currentPage()->toBe(1)
            ->perPage()->toBe(5)
            ->to()->toBe(1)
            ->from()->toBe(5);

        $response = $this->repository->paginate(order: 'desc', page: 2);
        $items    = collect($response->items());
        expect($items)
            ->first()->name->toBe('Category 2')
            ->last()->name->toBe('Category 1');
    });

    it('should update a entity', function () {
        $model = CategoryModel::factory()->create(['is_active' => false]);

        $domain = $this->repository->show($model->id);
        $domain->update(name: 'category update', description: 'description update');
        $domain->enable();

        $response = $this->repository->update($domain);

        expect($response)
            ->id()->toBe($model->id)
            ->createdAt()->toBe($model->created_at->format('Y-m-d H:i:s'))
            ->name->toBe("category update")
            ->description->toBe("description update")
            ->isActive->toBeTrue();

        assertDatabaseCount(CategoryModel::class, 1);
        assertDatabaseHas(CategoryModel::class, [
            'id'          => $response->id,
            'name'        => 'category update',
            'description' => 'description update',
            'is_active'   => true,
            'created_at'  => $response->createdAt,
        ]);
    });

    it('should delete a entity', function () {
        $model = CategoryModel::factory()->create();

        $response = $this->repository->delete($model->id);

        expect($response)->toBeTrue();
        assertSoftDeleted($model);
    });
});
