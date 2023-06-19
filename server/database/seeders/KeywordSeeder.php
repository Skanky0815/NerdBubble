<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Keyword;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keywords = [
            'star wars',
            'der herr der ringe',
            'the lord of the rings',
            'aventuria',
            'das schwarze auge',
            'dsa5',
            'star trek',
        ];

        foreach ($keywords as $keyword) {
            Keyword::create(['word' => $keyword]);
        }
    }
}
