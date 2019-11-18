<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        $data = [
            [
                'name'              => 'Super Admin',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('admin0101'),
                'email_verified_at' => Carbon::now(),
                'remember_token'    => "",
                'updated_at'        => Carbon::now(),
                'created_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Developer',
                'email'             => 'developer@admin.com',
                'password'          => bcrypt('admin0101'),
                'email_verified_at' => Carbon::now(),
                'remember_token'    => "",
                'updated_at'        => Carbon::now(),
                'created_at'        => Carbon::now(),
            ]
        ];
        foreach($data as $userData) {
            User::create($userData);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}