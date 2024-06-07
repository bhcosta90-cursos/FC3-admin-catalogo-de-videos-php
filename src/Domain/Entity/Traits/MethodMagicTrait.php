<?php

declare(strict_types = 1);

namespace Core\Domain\Entity\Traits;

use Core\Domain\Object\Id;
use DateTime;
use Exception;

trait MethodMagicTrait
{
    /**
     * @throws Exception
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        $className = get_class($this);

        throw new Exception("Property {$property} not found in class {$className}");
    }

    public function id(): string
    {
        if($this->id === null) {
            $this->id = Id::random();
        }

        return (string) $this->id;
    }

    public function createdAt(): string
    {
        if($this->createdAt === null) {
            $this->createdAt = new DateTime();
        }

        return $this->createdAt->format('Y-m-d H:i:s');
    }
}
