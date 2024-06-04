<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = collect([
            [
                'title' => 'News Title One',
                'slug' => 'news-title-one',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News Title Two',
                'slug' => 'news-title-two',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News Title Three',
                'slug' => 'news-title-three',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News Title Four',
                'slug' => 'news-title-four',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News Title Five',
                'slug' => 'news-title-five',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News Title Six',
                'slug' => 'news-title-six',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News Title Seven',
                'slug' => 'news-title-seven',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'News Title Eight',
                'slug' => 'news-title-eight',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, reiciendis',
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $posts->each(function($post){
            Post::insert($post);
        });
    }
}
