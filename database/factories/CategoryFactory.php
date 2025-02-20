<?php

declare(strict_types = 1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->name,
            'description' => $this->faker->sentence(2),
            'is_active'   => random_int(0, 1),
        ];
    }

    public function enable(): self
    {
        return $this->state(function () {
            return [
                'is_active' => 1,
            ];
        });
    }

    public function disable(): self
    {
        return $this->state(function () {
            return [
                'is_active' => 1,
            ];
        });
    }
}
