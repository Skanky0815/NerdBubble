<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name . ' - ' . $this->faker->company,
            'subTitle' => $this->faker->text,
            'newsType' => $this->faker->randomElement(['ASMODEE']),
            'link' => $this->faker->url,
            'date' => $this->faker->date,
            'image' => $this->faker->imageUrl,
        ];
    }
}
