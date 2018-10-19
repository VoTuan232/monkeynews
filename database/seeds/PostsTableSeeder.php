<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user2 = User::where('email', 'user2@gmail.com')->first();
        $user4 = User::where('email', 'user4@gmail.com')->first();
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) { 
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Post::create([
                'title' => $title, 
                'body' => $faker->text($maxNbChars = 1000),
                'slug' => str_slug($title),
                'published' => rand(0, 1),
                'image' => 'demo.jpg',
                'user_id' => $user2->id,
                'vote' => rand(0, 10),
                'view' => rand(0, 10)
            ]);
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Post::create([
                'title' => $title, 
                'body' => $faker->text($maxNbChars = 1000),
                'slug' => str_slug($title),
                'published' => rand(0, 1),
                'image' => 'demo.jpg',
                'user_id' => $user4->id,
                'vote' => rand(0, 10),
                'view' => rand(0, 10)
            ]);
        }
    }
}
