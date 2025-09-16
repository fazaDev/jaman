<?php

namespace Database\Factories;

use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AgendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agenda::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        $startDate = $this->faker->dateTimeBetween('-1 month', '+6 months');
        $endDate = (clone $startDate)->modify('+1 day');
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->realText(500),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => $this->faker->address,
            'status' => $this->faker->randomElement(['draft', 'published', 'cancelled', 'completed']),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'sort_order' => $this->faker->numberBetween(0, 100),
            'meta_description' => $this->faker->realText(160),
            'meta_keywords' => implode(', ', $this->faker->words(5)),
            'meta_data' => null,
        ];
    }

    /**
     * Indicate that the agenda is published.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
            ];
        });
    }

    /**
     * Indicate that the agenda is featured.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => true,
            ];
        });
    }

    /**
     * Indicate that the agenda is upcoming.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function upcoming()
    {
        return $this->state(function (array $attributes) {
            $startDate = $this->faker->dateTimeBetween('+1 day', '+1 month');
            $endDate = (clone $startDate)->modify('+1 day');
            
            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'published',
            ];
        });
    }

    /**
     * Indicate that the agenda is past.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function past()
    {
        return $this->state(function (array $attributes) {
            $endDate = $this->faker->dateTimeBetween('-1 year', '-1 day');
            $startDate = (clone $endDate)->modify('-1 day');            
            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'completed',
            ];
        });
    }
}