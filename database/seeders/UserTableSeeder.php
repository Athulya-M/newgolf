<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $role = Role::create(['name' => 'super_admin']);
        
        $user= \App\Models\User::create([
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'date_of_birth' => '2022-05-07 22:39:53',
            'phone'         => 00-0000000,
            'email'         => 'admin@admin.com',
            'password'      => bcrypt('password'),
            
        ]); 
        $user->assignRole($role);
    }
}
