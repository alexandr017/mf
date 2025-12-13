<?php

namespace App\Repositories\Site\Blog;

use Faker\Factory as Faker;
use Illuminate\Support\Collection;

class BlogRepository
{

    public function list(int $count = 10)
    {
        $faker = Faker::create('ru_RU');
        $posts = collect();

        for ($i = 0; $i < $count; $i++) {
            $title = $faker->sentence(5);
            $posts->push( ( object ) [
                'id' => $i + 1,
                'title' => $title,
                'preview' => '/v1/images/demo/news.jpg',
                'meta_description' => $faker->sentence(5),
                'h1' => $title,
                'alias' => \Str::slug($title),
                'short_content' => $faker->sentence(5),
                'content' => $faker->realText(500),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }

        return $posts;
    }
}
