<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProviderType;
use Carbon\CarbonImmutable;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\PublishDate;
use Domains\Article\ValueObjects\SubHeadline;
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
            'title' => new Headline($this->faker->name.' - '.$this->faker->company),
            'subTitle' => $this->faker->boolean ? new SubHeadline($this->faker->text) : null,
            'provider' => $this->faker->randomElement(ProviderType::getAllValues()),
            'description' => $this->faker->boolean ? $this->faker->text : null,
            'link' => $this->faker->url,
            'date' => new PublishDate(CarbonImmutable::parse($this->faker->date)),
            'image' => $this->faker->imageUrl,
        ];
    }
}
