    <?php

    use Illuminate\Database\Seeder;
    use App\Models\Role;
    use App\Models\User;

    class UsersTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $role1 = Role::where('slug', 'super-admin')->first();
            $role2 = Role::where('slug', 'administrator')->first();
            $role3 = Role::where('slug', 'editor')->first();
            $role4 = Role::where('slug', 'author')->first();
            $role5 = Role::where('slug', 'contributor')->first();
            $role6 = Role::where('slug', 'subscriber')->first();

            $user0 = User::create([
                'name' => 'Super Admin', 
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456')
            ]);
            $user0->roles()->attach($role1);
            
            $user1 = User::create([
                'name' => 'Khách hàng', 
                'email' => 'user1@gmail.com',
                'password' => bcrypt('123456')
            ]);

            $user2 = User::create([
                'name' => 'Administrator', 
                'email' => 'user2@gmail.com',
                'password' => bcrypt('123456')
            ]);
            $user2->roles()->attach($role2);
            
            $user3 = User::create([
                'name' => 'Editor', 
                'email' => 'user3@gmail.com',
                'password' => bcrypt('123456')
            ]);
            $user3->roles()->attach($role3);

            $user4 = User::create([
                'name' => 'Author', 
                'email' => 'user4@gmail.com',
                'password' => bcrypt('123456')
            ]);
            $user4->roles()->attach($role4);
            // $user4->roles()->attach($role4);
            // $user4->roles()->attach($role5);
            // $user4->roles()->attach($role6);

            $user5 = User::create([
                'name' => 'Contributor', 
                'email' => 'user5@gmail.com',
                'password' => bcrypt('123456')
            ]);
            $user5->roles()->attach($role5);

            $user6 = User::create([
                'name' => 'Subscriber', 
                'email' => 'user6@gmail.com',
                'password' => bcrypt('123456')
            ]);
            $user6->roles()->attach($role6);


            // $role7 = Role::where('slug', 'tao-bai-viet')->first();
            // $user5->roles()->attach($role7);

            // $role1 = Role::where('slug', 'tao-bai-viet')->first();
            // $role2 = Role::where('slug', 'dang-bai-viet')->first();
            // $role3 = Role::where('slug', 'quan-li-chuyen-muc')->first();
            // $role4 = Role::where('slug', 'quan-li-nguoi-dung')->first();
            // $role5 = Role::where('slug', 'quan-li-binh-luan')->first();
            // $role6 = Role::where('slug', 'quan-li-the')->first();
            // $superadmin = Role::where('slug', 'super-admin')->first();

            // $user0 = User::create([
            //     'name' => 'Super Admin', 
            //     'email' => 'admin@gmail.com',
            //     'password' => bcrypt('123456')
            // ]);
            // $user0->roles()->attach($superadmin);
            
            // $user1 = User::create([
            //     'name' => 'User 1', 
            //     'email' => 'user1@gmail.com',
            //     'password' => bcrypt('123456')
            // ]);

            // $user2 = User::create([
            //     'name' => 'User 2', 
            //     'email' => 'user2@gmail.com',
            //     'password' => bcrypt('123456')
            // ]);
            // $user2->roles()->attach($role1);
            
            // $user3 = User::create([
            //     'name' => 'User 3', 
            //     'email' => 'user3@gmail.com',
            //     'password' => bcrypt('123456')
            // ]);
            // $user3->roles()->attach($role2);

            // $user4 = User::create([
            //     'name' => 'User 4', 
            //     'email' => 'user4@gmail.com',
            //     'password' => bcrypt('123456')
            // ]);
            // $user4->roles()->attach($role3);
            // $user4->roles()->attach($role4);
            // $user4->roles()->attach($role5);
            // $user4->roles()->attach($role6);

            // $user5 = User::create([
            //     'name' => 'User 5', 
            //     'email' => 'user5@gmail.com',
            //     'password' => bcrypt('123456')
            // ]);

            // $role7 = Role::where('slug', 'tao-bai-viet')->first();
            // $user5->roles()->attach($role7);
        }
    }
