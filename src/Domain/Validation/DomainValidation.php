<?php

declare(strict_types = 1);

namespace Core\Domain\Validation;

use Core\Domain\Entity\Exception\EntityValidationException;

final class DomainValidation
{
    public static function notNull(string $value, string $exceptMessage = null): void
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptMessage ?? 'Should not be empty or null');
        }
    }

    public static function strMaxLength(string $value, int $length = 255, string $exceptMessage = null): void
    {
        if (strlen($value) >= $length) {
            throw new EntityValidationException(
                $exceptMessage ?? "The value must not be greater than {$length} characters"
            );
        }
    }

    public static function strMinLength(string $value, int $length = 3, string $exceptMessage = null): void
    {
        if (strlen($value) < $length) {
            throw new EntityValidationException($exceptMessage ?? "The value must be at least {$length} characters");
        }
    }

    public static function strCanNullAndMaxLength(
        string $value = null,
        int $length = 255,
        string $exceptMessage = null
    ): void {
        if (!empty($value) && strlen($value) > $length) {
            throw new EntityValidationException(
                $exceptMessage ?? "The value must not be greater than {$length} characters"
            );
        }
    }

    public static function strCanNullAndMinLength(
        string $value = null,
        int $length = 3,
        string $exceptMessage = null
    ): void {
        if ($value && strlen($value) < $length) {
            throw new EntityValidationException($exceptMessage ?? "The value must be at least {$length} characters");
        }
    }
}
