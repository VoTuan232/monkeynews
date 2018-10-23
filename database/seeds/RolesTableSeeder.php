<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role0 = Role::create([
            'name' => 'Super Admin', 
            'slug' => 'super-admin',
            'permissions' => [
                'all permissions' => true,
                'post.create' => true,
                'post.update' => true,
                'post.delete' => true,
                'post.publish' => true,
                'category.create' => true,
                'category.update' => true,
                'category.delete' => true,
                'tag.create' => true,
                'tag.update' => true,
                'tag.delete' => true,
                'user.create' => true,
                'user.update' => true,
                'user.delete' => true,
                'role.create' => true,
                'role.update' => true,
                'role.delete' => true,
            ]
        ]);

        $role1 = Role::create([
            'name' => 'Administrator', 
            'slug' => 'administrator',
            'permissions' => [
                'post.create' => true,
                'post.publish' => true,
                'post.delete' => true,
                'tag.update' => true,
                'category.delete' => true,
                'user.update' => true,
            ]
        ]);

        $role2 = Role::create([
            'name' => 'Editor', 
            'slug' => 'editor',
            'permissions' => [
                'post.publish' => true,
                'post.delete' => true,
                'post.update' => true,

            ]
        ]);

        $role3 = Role::create([
            'name' => 'Author', 
            'slug' => 'author',
            'permissions' => [
                'post.create' => true,
            ]
        ]);

        $role4 = Role::create([
            'name' => 'Contributor', 
            'slug' => 'contributor',
            'permissions' => [
                'post.create' => true,
            ]
        ]);

        $role5 = Role::create([
            'name' => 'Subscriber', 
            'slug' => 'subscriber',
            'permissions' => [
            ]
        ]);

        // $role1 = Role::create([
        //     'name' => 'Tạo bài viết', 
        //     'slug' => 'tao-bai-viet',
        //     'permissions' => [
        //         'post.create' => true,
        //     ]
        // ]);

        // $role2 = Role::create([
        //     'name' => 'Đăng bài viết', 
        //     'slug' => 'dang-bai-viet',
        //     'permissions' => [
        //         'post.publish' => true,
        //         'post.delete' => true,
        //         'post.update' => true,

        //     ]
        // ]);

        // $role3 = Role::create([
        //     'name' => 'Quản lí chuyên mục', 
        //     'slug' => 'quan-li-chuyen-muc',
        //     'permissions' => [
        //         'category.create' => true,
        //         'category.update' => true,
        //         'category.delete' => true,
        //     ]
        // ]);

        // $role4 = Role::create([
        //     'name' => 'Quản lí người dùng', 
        //     'slug' => 'quan-li-nguoi-dung',
        //     'permissions' => [
        //         'user.create' => true,
        //         'user.update' => true,
        //         'user.detele' => true,
        //     ]
        // ]);

        // $role5 = Role::create([
        //     'name' => 'Quản lí bình luận', 
        //     'slug' => 'quan-li-binh-luan',
        //     'permissions' => [
        //         'comment.update' => true,
        //         'comment.delete' => true,
        //     ]
        // ]);


        // $role6 = Role::create([
        //     'name' => 'Quản lí thẻ', 
        //     'slug' => 'quan-li-the',
        //     'permissions' => [
        //         'tag.create' => true,
        //         'tag.update' => true,
        //         'tag.delete' => true,
        //     ]
        // ]);
    }
}
