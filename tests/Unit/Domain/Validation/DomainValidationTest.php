<?php

declare(strict_types=1);

use Core\Domain\Entity\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;

describe("DomainValidation Unit Test", function () {
    it("should validate not null", function () {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Should not be empty or null');
        DomainValidation::notNull('');
    });

    it("should validate string max length", function () {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('The value must not be greater than 3 characters');
        DomainValidation::strMaxLength('string', 3);
    });

    it("should validate string min length", function () {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('The value must be at least 3 characters');
        DomainValidation::strMinLength('st', 3);
    });

    it("should validate string can null and max length", function () {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('The value must not be greater than 3 characters');
        DomainValidation::strCanNullAndMaxLength('string', 3);
    });

    it("should validate string can null and min length", function () {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('The value must be at least 3 characters');
        DomainValidation::strCanNullAndMinLength('st', 3);
    });
});
