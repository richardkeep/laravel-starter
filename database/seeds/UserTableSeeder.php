<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super_admin']);

        Role::create(['name' => 'user']);

        User::create([
            'name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => bcrypt('password'),
        ])->assignRole('super_admin');

        User::create([
            'name' => 'Piyush Maurya',
            'email' => 'piyush.maurya@focalworks.in',
            'password' => bcrypt('password'),
        ])->assignRole('super_admin');

        User::create([
            'name' => 'Manish Manghwani',
            'email' => 'manish.manghwani@focalworks.in',
            'password' => bcrypt('password'),
        ])->assignRole('super_admin');
    }
}
