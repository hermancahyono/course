<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Herman Cahyono',
            'username' => 'herman-cahyono',
            'email' => 'hermanc@gmail.com',
            'password' => bcrypt('hermanc123')
        ]);

        $role = Role::find(1);

        $user->assignRole($role);
    }
}
