<?php

declare(strict_types = 1);

namespace App\Repositories\Eloquent;

use App\Models\Category as CategoryModel;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Application\Contract\PaginationInterface;
use Core\Domain\Entity\Category;
use Core\Domain\Object\Id;
use Core\Domain\Repository\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(protected CategoryModel $category)
    {
    }

    public function insert(Category $category): Category
    {
        $entityDb = $this->category->create([
            'id'          => $category->id(),
            'created_at'  => $category->createdAt(),
            'name'        => $category->name,
            'is_active'   => $category->isActive,
            'description' => $category->description,
        ]);

        return $this->toEntity($entityDb);
    }

    public function show(string $id): Category
    {
        return $this->toEntity(CategoryModel::findOrFail($id));
    }

    public function paginate(
        string $filter = null,
        ?string $order = 'ASC',
        int $page = 1,
        int $limit = 10
    ): PaginationInterface {
        return PaginationPresenter::make($this->category->query()
            ->filter('name', $filter)
            ->orderBy('name', $order)
            ->paginate($limit, ['*'], 'page', $page));
    }

    public function update(Category $category): Category
    {
        $model = CategoryModel::findOrFail($category->id());
        $model->update([
            'name'        => $category->name,
            'is_active'   => $category->isActive,
            'description' => $category->description,
        ]);

        return $this->toEntity($model);
    }

    public function delete(string $id): bool
    {
        return CategoryModel::findOrFail($id)->delete();
    }

    protected function toEntity(object $category): Category
    {
        return new Category(
            name: $category->name,
            isActive: $category->is_active,
            description: $category->description,
            id: new Id($category->id),
            createdAt: $category->created_at,
        );
    }
}
