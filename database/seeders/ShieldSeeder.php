<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_ktp","view_any_ktp","create_ktp","update_ktp","restore_ktp","restore_any_ktp","replicate_ktp","reorder_ktp","delete_ktp","delete_any_ktp","force_delete_ktp","force_delete_any_ktp","view_nib","view_any_nib","create_nib","update_nib","restore_nib","restore_any_nib","replicate_nib","reorder_nib","delete_nib","delete_any_nib","force_delete_nib","force_delete_any_nib","view_surat","view_any_surat","create_surat","update_surat","restore_surat","restore_any_surat","replicate_surat","reorder_surat","delete_surat","delete_any_surat","force_delete_surat","force_delete_any_surat","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","widget_StatsDashboard"]},{"name":"Read","guard_name":"web","permissions":["view_ktp","view_nib"]}]';
        $directPermissions = '[{"name":"view_role","guard_name":"web"},{"name":"view_any_role","guard_name":"web"},{"name":"create_role","guard_name":"web"},{"name":"update_role","guard_name":"web"},{"name":"delete_role","guard_name":"web"},{"name":"delete_any_role","guard_name":"web"}]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
