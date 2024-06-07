<?php

declare(strict_types = 1);

namespace Core\Domain\Object;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final readonly class Id implements Contract\ObjectInterface
{
    public function __construct(
        protected string $value,
    ) {
        $this->ensureIsValid($value);
    }

    protected function ensureIsValid(string $id): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }

    public static function random(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
