<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create admin and frontdesk permission
        $permission = [
            'admin',
            'frontdesk',
        ];
        foreach($permission as $permission){
            Permission::create(['name' => $permission]);
        }
        //create admin and frontdesk role
        $role = [
            'admin',
            'frontdesk',
        ];
        foreach($role as $role){
            Role::create(['name' => $role]);
        }

        //assign permission to role
        $adminRole = Role::where('name', 'admin')->first();
        $adminPermission = Permission::all();
        //give all the permission to admin role
        foreach($adminPermission as $permission){
            $adminRole->givePermissionTo($permission);
        }
        
        //give only frontdesk permission to frontdesk role
        $frontdeskRole = Role::where('name', 'frontdesk')->first();
        $frontdeskPermission = Permission::where('name', 'frontdesk')->first();
        $frontdeskRole->givePermissionTo($frontdeskPermission);
    }
}
