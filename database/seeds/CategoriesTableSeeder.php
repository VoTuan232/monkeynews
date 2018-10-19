<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => '1',
            'name' => 'Thể thao',
        ]);

        DB::table('categories')->insert([
            'id'  => '2',
            'name' => 'Giải trí',
        ]);

        DB::table('categories')->insert([
            'id'  => '3',
            'name' => 'Kinh tế',
        ]);

        DB::table('categories')->insert([
            'id'  => '4',
            'name' => 'Công nghệ',
        ]);

        DB::table('categories')->insert([
            'id'  => '5',
            'name' => 'Văn hóa',
        ]);

        DB::table('categories')->insert([
            'id'  => '6',
            'name' => 'Bóng đá',
            'parent_id' => '1',
        ]);

        DB::table('categories')->insert([
            'id'  => '7',
            'name' => 'Cầu lông',
            'parent_id' => '1',
        ]);

        DB::table('categories')->insert([
            'id'  => '8',
            'name' => 'Bất động sản',
            'parent_id' => '3',
        ]);

        DB::table('categories')->insert([
            'id'  => '9',
            'name' => 'Ca nhạc',
            'parent_id' => '4',
        ]);
    }
}
