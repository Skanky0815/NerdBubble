<?php declare(strict_types=1);

namespace Database\Factories;

use App\Models\Provider;
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
            'subTitle' => $this->faker->boolean ? $this->faker->text : null,
            'provider' => $this->faker->randomElement(Provider::getAllValues()),
            'description' => $this->faker->boolean ? $this->faker->text : null,
            'link' => $this->faker->url,
            'date' => $this->faker->date,
            'image' => $this->faker->imageUrl,
        ];
    }
}
