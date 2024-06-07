<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFilterTrait
{
    public function scopeFilter(Builder $query, string $column, ?string $filter): Builder
    {
        return $query->when($filter, fn() => $this->where($column, 'like', "%$filter%"));
    }
}
