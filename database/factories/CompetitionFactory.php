<?php

namespace Database\Factories;
use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competition>
 */
class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('-1 month', 'now');
        $end_date = $this->faker->dateTimeBetween($start_date, '+1 month');
        $raffle_date = $this->faker->dateTimeBetween($end_date, '+2 months');
        return [
            'tittle' => $this->faker->sentence(5),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'raffle_date' => $raffle_date,
            'scholarship_amount' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
