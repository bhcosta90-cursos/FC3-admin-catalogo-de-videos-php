<?php

declare(strict_types = 1);

namespace Core\Application\Category\DataTransfer;

readonly class CategoryOutput
{
    public function __construct(
        public string $id,
        public string $name,
        public bool $is_active,
        public ?string $description,
        public string $created_at,
    ) {
    }
}
