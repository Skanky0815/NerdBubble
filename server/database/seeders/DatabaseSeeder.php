<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rico Schulz',
            'email' => 'rico-schulz@web.de',
            'password' => bcrypt('password'),
        ]);
    }
}
