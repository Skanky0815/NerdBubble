<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Product;
use App\Models\ProviderType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class E2ETestSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@nerdbubble.org',
            'password' => bcrypt('password'),
        ]);

        Article::factory()->create([
            'title' => 'Einfacher Artikel',
            'description' => 'Das ist ein einfacher Artikel ohne produkt aber dafür mit Beschreibung ',
            'provider' => ProviderType::RAIL_SIM,
            'date' => Carbon::now(),
        ]);

        $articleWithProduct = Article::factory()->create([
            'title' => 'Artikel mit einem Produkt',
            'subTitle' => 'Dieser Artikel hat ein Produkt',
            'provider' => ProviderType::ASMODEE,
            'date' => Carbon::now(),
        ]);

        Product::factory()->create([
            'name' => 'Das Produkt',
            'article_id' => $articleWithProduct->id,
        ]);
    }
}
