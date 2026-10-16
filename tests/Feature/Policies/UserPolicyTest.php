<?php

declare(strict_types=1);

namespace Tests\Feature\Policies;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    private function getRole(string $name): Role
    {
        return Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
    }

    public function test_regular_user_can_only_view_themselves(): void
    {
        $this->getRole('contributor');
        $user = User::factory()->create();
        $user->assignRole('contributor');

        $otherUser = User::factory()->create();
        $policy = new UserPolicy();

        $this->assertFalse($policy->viewAny($user));
        $this->assertFalse($policy->view($user, $otherUser));
        $this->assertTrue($policy->view($user, $user)); // Can view self
    }

    public function test_admin_cannot_delete_themselves(): void
    {
        $this->getRole('admin');
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $policy = new UserPolicy();

        $this->assertFalse($policy->delete($admin, $admin));
    }

    public function test_admin_can_delete_other_users(): void
    {
        $this->getRole('admin');
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $otherUser = User::factory()->create();
        $policy = new UserPolicy();

        $this->assertTrue($policy->delete($admin, $otherUser));
    }
}