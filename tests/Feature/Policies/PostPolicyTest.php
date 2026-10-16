<?php

declare(strict_types=1);

namespace Tests\Feature\Policies;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    private function getRole(string $name): Role
    {
        return Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
    }

    public function test_guest_can_view_published_post(): void
    {
        $post = Post::factory()->create(['status' => 'published']);
        $policy = new PostPolicy();

        $this->assertTrue($policy->view(null, $post));
    }

    public function test_guest_cannot_view_draft_post(): void
    {
        $post = Post::factory()->create(['status' => 'draft']);
        $policy = new PostPolicy();

        $this->assertFalse($policy->view(null, $post));
    }

    public function test_admin_can_update_and_delete_any_post(): void
    {
        $this->getRole('admin');
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $otherUser = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $otherUser->id, 'status' => 'published']);
        $policy = new PostPolicy();

        $this->assertTrue($policy->update($admin, $post));
        $this->assertTrue($policy->delete($admin, $post));
    }

    public function test_author_can_update_own_draft_post(): void
    {
        $this->getRole('author');
        $author = User::factory()->create();
        $author->assignRole('author');

        $post = Post::factory()->create(['user_id' => $author->id, 'status' => 'draft']);
        $policy = new PostPolicy();

        $this->assertTrue($policy->update($author, $post));
    }

    public function test_author_cannot_update_others_post(): void
    {
        $this->getRole('author');
        $author = User::factory()->create();
        $author->assignRole('author');

        $otherUser = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $otherUser->id, 'status' => 'draft']);
        $policy = new PostPolicy();

        $this->assertFalse($policy->update($author, $post));
    }

    public function test_author_cannot_delete_any_post(): void
    {
        $this->getRole('author');
        $author = User::factory()->create();
        $author->assignRole('author');

        $post = Post::factory()->create(['user_id' => $author->id, 'status' => 'draft']);
        $policy = new PostPolicy();

        $this->assertFalse($policy->delete($author, $post));
    }
}