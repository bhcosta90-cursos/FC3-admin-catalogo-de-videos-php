<?php

declare(strict_types = 1);

namespace Core\Application\Category\DataTransfer;

class CategoryInsertInput
{
    public function __construct(public string $name, public ?string $description)
    {
    }
}
