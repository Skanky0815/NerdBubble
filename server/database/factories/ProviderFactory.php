<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ArticleLayout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hasProducts = $this->faker->boolean(20);

        return [
            'name' => $this->faker->company(),
            'color' => $this->faker->hexColor(),
            'logoImage' => $this->faker->imageUrl(250, 250),
            'aggregateUrl' => 'https://www.nerd-bubble.de',
            'hasProducts' => $hasProducts,
            'layout' => $hasProducts ? ArticleLayout::PRODUCTS : $this->faker->randomElement(ArticleLayout::getAllValues()),
            'isActive' => $this->faker->boolean(),
            'articleSelectorWrapper' => './/div',
            'articleSelectorHeadline' => $hasProducts ? null : './/div/div/header/h1/a',
            'articleHeadline' => $hasProducts ? $this->faker->words(2, true) : null,
            'articleSelectorSubHeadline' => $this->faker->boolean() ? $this->faker->words(4, true) : null,
            'articleSelectorDescription' => $this->faker->boolean() ? $this->faker->paragraph(1) : null,
            'articleSelectorImage' => './/div/a/img',
            'articleImage' => $hasProducts ? $this->faker->imageUrl(200, 100) : null,
            'articleSelectorDate' => './/div/span',
            'articleSelectorDateFormat' => 'Y-m-d',
            'articleSelectorDateLocale' => 'de_DE',
            'articleSelectorLink' => $hasProducts ? './/div/a' : null,
            'articleLink' => $hasProducts ? './/div/a/img' : 'https://www.nerd-bubble.de',

            'productSelectorWrapper' => $hasProducts ? './/div/div' : null,
            'productSelectorName' => $hasProducts ? './/div/h1' : null,
            'productSelectorImage' => $hasProducts ? './/div/img' : null,
            'productSelectorLink' => $hasProducts ? './/div/a' : null,
        ];
    }

    public function withProduct(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'hasProducts' => true,
                'layout' => ArticleLayout::PRODUCTS,
                'productSelectorWrapper' => './/div/div',
                'productSelectorName' => './/div/h1',
                'productSelectorImage' => './/div/img',
                'productSelectorLink' => './/div/a',
            ];
        });
    }
}
