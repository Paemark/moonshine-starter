<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function allowRestify(?User $user = null): bool
    {
        return true;
    }

    public function viewAny(?User $user = null): bool
    {
        return true;
    }

    public function view(?User $user, Post $post): bool
    {
        return $post->status === 'published'
            || ($user !== null && $user->hasRole('admin'));
    }

    public function show(?User $user, Post $post): bool
    {
        return $this->view($user, $post);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'editor', 'author']);
    }

    public function store(User $user): bool
    {
        return $this->create($user);
    }

    public function update(User $user, Post $post): bool
    {
        return $user->hasRole('admin')
            || (
                $user->hasAnyRole(['editor', 'author'])
                && (int) $post->user_id === (int) $user->id
            );
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }
}
