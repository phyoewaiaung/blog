<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Article::factory(20)->create();
        Category::factory(5)->create();
        Comment::factory(40)->create();

        User::factory()->create([
            'name' => 'phyoe',
            'email' => 'phyoe@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'phoo',
            'email' => 'phoo@gmail.com',
        ]);
    }
}
