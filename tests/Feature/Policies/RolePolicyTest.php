<?php

declare(strict_types=1);

namespace Tests\Feature\Policies;

use App\Models\User;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolePolicyTest extends TestCase
{
    use RefreshDatabase;

    private function getRole(string $name): Role
    {
        return Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
    }

    public function test_non_admin_cannot_manage_roles(): void
    {
        $this->getRole('editor');
        $editor = User::factory()->create();
        $editor->assignRole('editor');

        $role = $this->getRole('contributor');
        $policy = new RolePolicy();

        $this->assertFalse($policy->viewAny($editor));
        $this->assertFalse($policy->create($editor));
        $this->assertFalse($policy->update($editor, $role));
        $this->assertFalse($policy->delete($editor, $role));
    }

    public function test_admin_has_full_control_over_roles(): void
    {
        $this->getRole('admin');
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $role = $this->getRole('editor');
        $policy = new RolePolicy();

        $this->assertTrue($policy->viewAny($admin));
        $this->assertTrue($policy->view($admin, $role));
        $this->assertTrue($policy->create($admin));
        $this->assertTrue($policy->update($admin, $role));
        $this->assertTrue($policy->delete($admin, $role));
    }
}