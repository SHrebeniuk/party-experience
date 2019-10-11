<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
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
                'name' => Role::ROLE_ADMIN_NAME,
            ],
            [
                'name' => Role::ROLE_MANAGER_NAME,
            ],
            [
                'name' => Role::ROLE_USER_NAME,
            ],
        ];

        foreach($roles as $key=>$role)
        {
            if (!Role::find($key + 1)) {
                Role::create($role);
            }
        }
    }
}
