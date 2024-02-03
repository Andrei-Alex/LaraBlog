<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create([
            'email' => 'admin@mail.fr',
        ]);
        $this->call([
                ArticleSeeder::class,
                CategorySeeder::class,
                TagSeeder::class,
                PostSeeder::class,]);
    }
}
