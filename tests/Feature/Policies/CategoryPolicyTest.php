<?php

declare(strict_types=1);

namespace Tests\Feature\Policies;

use App\Models\Category;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CategoryPolicyTest extends TestCase
{
    use RefreshDatabase;

    private function getRole(string $name): Role
    {
        return Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
    }

    public function test_contributor_can_view_but_not_delete_category(): void
    {
        $this->getRole('contributor');
        $contributor = User::factory()->create();
        $contributor->assignRole('contributor');

        $category = Category::factory()->create();
        $policy = new CategoryPolicy();

        $this->assertTrue($policy->view($contributor, $category));
        $this->assertFalse($policy->delete($contributor, $category));
    }

    public function test_editor_can_update_but_not_delete_category(): void
    {
        $this->getRole('editor');
        $editor = User::factory()->create();
        $editor->assignRole('editor');

        $category = Category::factory()->create();
        $policy = new CategoryPolicy();

        $this->assertTrue($policy->update($editor, $category));
        $this->assertFalse($policy->delete($editor, $category));
    }

    public function test_admin_has_full_control_over_category(): void
    {
        $this->getRole('admin');
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $category = Category::factory()->create();
        $policy = new CategoryPolicy();

        $this->assertTrue($policy->viewAny($admin));
        $this->assertTrue($policy->create($admin));
        $this->assertTrue($policy->update($admin, $category));
        $this->assertTrue($policy->delete($admin, $category));
        $this->assertTrue($policy->restore($admin, $category));
        $this->assertTrue($policy->forceDelete($admin, $category));
    }
}