<?php

namespace Database\Factories;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscribe>
 */
class SubscribeFactory extends Factory
{
    protected $model = Subscribe::class;
    public function definition(): array
    {
        return [
            'id_competition' => $this->faker->numberBetween(1, 10),
            'id_user' => $this->faker->numberBetween(1, 50),
        ];
    }
}
