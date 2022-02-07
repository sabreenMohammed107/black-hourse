<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',

            'password' => bcrypt('123456')
        ]);

        $role = Role::create(['name' => 'Admin']);
        // for update data  ande comment this row =>$user->assignRole([$role->id]);
        // $user=User::where('name','Admin')->first();
        // $role = Role::where('name','Admin')->first();
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        //  $user->update(['branch_id'=>1]);

    }
}
