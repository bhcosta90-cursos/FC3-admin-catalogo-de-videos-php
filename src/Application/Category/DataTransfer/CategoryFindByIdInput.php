<?php

declare(strict_types = 1);

namespace Core\Application\Category\DataTransfer;

class CategoryFindByIdInput
{
    public function __construct(public string $id)
    {
    }
}
