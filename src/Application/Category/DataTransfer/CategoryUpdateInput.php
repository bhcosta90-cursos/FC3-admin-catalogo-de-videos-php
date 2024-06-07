<?php

declare(strict_types = 1);

namespace Core\Application\Category\DataTransfer;

class CategoryUpdateInput
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description,
        public bool
    $isActive
    ) {
    }
}
