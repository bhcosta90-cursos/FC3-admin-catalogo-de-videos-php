<?php declare(strict_types = 1);

use Core\Domain\Object\Contract\ObjectInterface;

arch('core')
    ->expect('Core\Domain\Object')
    ->toBeReadonly()
    ->ignoring(ObjectInterface::class)
    ->toBeFinal()
    ->ignoring(ObjectInterface::class)
    ->toImplement(ObjectInterface::class);
