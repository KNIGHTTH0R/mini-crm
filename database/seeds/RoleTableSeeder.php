<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'user';
        $role_employee->descriptions = 'A User Role';
        $role_employee->save();

        $role_employee = new Role();
        $role_employee->name = 'admin';
        $role_employee->descriptions = 'A Admin Role';
        $role_employee->save();
    }
}
