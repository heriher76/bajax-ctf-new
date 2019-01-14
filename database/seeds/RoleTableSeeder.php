<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $roles = [
			[
                'name'=>'Administrator',
                'access'=>[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16],
            ],
			[
                'name'=>'Alumni',
                'access'=>[5,13],
            ],
			[
                'name'=>'Anggota',
                'access'=>[5],
            ],
       ];
        foreach ($roles as $role) {
            $r = Role::create(['name' => $role['name']]);
            $r->syncPermissions($role['access']);
        }
    }
}
