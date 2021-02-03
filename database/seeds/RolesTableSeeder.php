<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.admin'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'accountant']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => 'Contador',
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'manager']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => 'Gerente',
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'admon']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => 'Administrador gerencial',
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'auditor']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => 'Auditor',
            ])->save();
        }
    }
}
