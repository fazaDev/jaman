<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->realText(2000),
            'excerpt' => $this->faker->realText(200),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 month'),
            'expires_at' => $this->faker->optional(0.3)->dateTimeBetween('+1 month', '+1 year'), // 30% chance of having expiration
            'sort_order' => $this->faker->numberBetween(0, 100),
            'meta_description' => $this->faker->realText(160),
            'meta_keywords' => implode(', ', $this->faker->words(5)),
            'meta_data' => null,
        ];
    }

    /**
     * Indicate that the announcement is published.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'published',
                'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            ];
        });
    }

    /**
     * Indicate that the announcement is featured.
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
     * Indicate that the announcement is draft.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'draft',
                'published_at' => null,
            ];
        });
    }
}