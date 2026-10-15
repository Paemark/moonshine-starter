<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define granular permissions
        $permissions = [
            'manage-users', 'manage-roles', 'manage-settings',
            'create-posts', 'edit-posts', 'delete-posts', 'publish-posts', 'view-posts'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Admin: Full system access
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        // Editor: Can create, edit, publish, and delete content
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $editor->syncPermissions(['create-posts', 'edit-posts', 'delete-posts', 'publish-posts', 'view-posts']);

        // Contributor: Can create and edit own content, cannot publish/delete
        $contributor = Role::firstOrCreate(['name' => 'contributor', 'guard_name' => 'web']);
        $contributor->syncPermissions(['create-posts', 'edit-posts', 'view-posts']);
    }
}