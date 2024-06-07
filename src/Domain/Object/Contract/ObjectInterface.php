<?php

declare(strict_types = 1);

namespace Core\Domain\Object\Contract;

interface ObjectInterface
{
    public function __toString(): string;
}
