<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;

class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = [
        //     [
        //         'id' => '1',
        //         'post_id' => '1',
        //         'category_id' => '5',
        //     ],
        //     [
        //         'id' => '2',
        //         'post_id' => '2',
        //         'category_id' => '6',
        //     ],  
        //     [
        //         'id' => '3',
        //         'post_id' => '3',
        //         'category_id' => '7',
        //     ],  
        //     [
        //         'id' => '4',
        //         'post_id' => '4',
        //         'category_id' => '8',
        //     ],
        //     [
        //         'id' => '5',
        //         'post_id' => '5',
        //         'category_id' => '5',
        //     ],
        //     [
        //         'id' => '6',
        //         'post_id' => '6',
        //         'category_id' => '6',
        //     ],  
        //     [
        //         'id' => '7',
        //         'post_id' => '7',
        //         'category_id' => '5',
        //     ],  
        //     [
        //         'id' => '8',
        //         'post_id' => '8',
        //         'category_id' => '6',
        //     ],  
        //     [
        //         'id' => '9',
        //         'post_id' => '9',
        //         'category_id' => '8',
        //     ],  
        //     [
        //         'id' => '10',
        //         'post_id' => '10',
        //         'category_id' => '5',
        //     ],  
        //     [
        //         'id' => '11',
        //         'post_id' => '11',
        //         'category_id' => '8',
        //     ],  
        //     [
        //         'id' => '12',
        //         'post_id' => '12',
        //         'category_id' => '6',
        //     ],  
        //     [
        //         'id' => '13',
        //         'post_id' => '13',
        //         'category_id' => '5',
        //     ],  
        //     [
        //         'id' => '14',
        //         'post_id' => '14',
        //         'category_id' => '7',
        //     ],  
        //     [
        //         'id' => '15',
        //         'post_id' => '15',
        //         'category_id' => '6',
        //     ],  
        //     [
        //         'id' => '16',
        //         'post_id' => '16',
        //         'category_id' => '8',
        //     ],  
        //     [
        //         'id' => '17',
        //         'post_id' => '17',
        //         'category_id' => '8',
        //     ],  
        //     [
        //         'id' => '18',
        //         'post_id' => '18',
        //         'category_id' => '6',
        //     ],  
        //     [
        //         'id' => '19',
        //         'post_id' => '19',
        //         'category_id' => '7',
        //     ],  
        //     [
        //         'id' => '20',
        //         'post_id' => '20',
        //         'category_id' => '5',
        //     ],          
        // ];

        // DB::table('category_post')->insert($data);
        // 
        
        //chi tao post tai category do, ko tao post o cac category con nua
        $categories = Category::whereNotNull('parent_id')->get();

        $posts = Post::all();

        foreach($posts as $post){
            $category = $categories->random();
            $data = [
                [
                    'post_id' => $post->id,
                    'category_id' => $category->id,
                ],
            ];
            DB::table('category_post')->insert($data);
        }

        // $categories = Category::whereNotNull('parent_id')->get();

        // $posts = Post::all();

        // foreach($posts as $post){
        //     $category = $categories->random();
        //     $parentCategory = Category::where('id', '=', $category->parent_id)->first(); //category cha.
        //     $data = [
        //         [
        //             'post_id' => $post->id,
        //             'category_id' => $category->id,
        //         ],
        //         [
        //             'post_id' => $post->id,
        //             'category_id' => $parentCategory->id,
        //         ],
        //     ];
        //     DB::table('category_post')->insert($data);
        // }

    }
            
}
