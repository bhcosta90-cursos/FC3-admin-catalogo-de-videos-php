<?php

declare(strict_types = 1);

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodMagicTrait;
use Core\Domain\Object\Id;
use Core\Domain\Validation\DomainValidation;
use DateTime;

final class Category
{
    use MethodMagicTrait;

    public function __construct(
        protected string $name,
        protected bool $isActive = true,
        protected ?string $description = null,
        protected ?Id $id = null,
        protected ?DateTime $createdAt = null,
    ) {
        $this->validate();
    }

    public function enable(): void
    {
        $this->isActive = true;
    }

    public function disable(): void
    {
        $this->isActive = false;
    }

    public function update(string $name, ?string $description): void
    {
        $this->name        = $name;
        $this->description = $description;
        $this->validate();
    }

    protected function validate(): void
    {
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
        DomainValidation::strCanNullAndMinLength($this->description);
        DomainValidation::strCanNullAndMaxLength($this->description);
    }
}
