<?php

declare(strict_types = 1);

namespace Core\Application\Exception;

use Exception;
use Throwable;

class EntityNotFoundException extends Exception
{
    public function __construct(string $domain, string $id, int $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Entity %s with id %s not found', mb_strtolower($domain), $id);

        parent::__construct($message, $code, $previous);
    }
}
