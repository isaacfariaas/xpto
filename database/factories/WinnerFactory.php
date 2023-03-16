<?php

namespace Database\Factories;
use App\Models\Winner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WinnerFactory extends Factory
{
    protected $model = Winner::class;
    public function definition(): array
    {
        return [
            'id_competition' => $this->faker->numberBetween(1, 10),
            'id_subscribe' => $this->faker->numberBetween(1, 50),
        ];
    }
}
