<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('contributor');
    }

    public function view(User $user, Post $post): bool
    {
        // Anyone can view published posts. Authors/Admins/Editors can view drafts.
        if ($post->status === 'published') {
            return true;
        }
        return $user->hasRole('admin') || 
               ($user->hasRole('editor') && $post->user_id === $user->id) || 
               ($user->hasRole('contributor') && $post->user_id === $user->id);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('contributor');
    }

    public function update(User $user, Post $post): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        if ($user->hasRole('editor') && $post->user_id === $user->id) {
            return true;
        }

        // Contributors can only edit their own UNPUBLISHED posts
        if ($user->hasRole('contributor') && $post->user_id === $user->id && $post->status !== 'published') {
            return true;
        }

        return false;
    }

    public function delete(User $user, Post $post): bool
    {
        // Contributors CANNOT delete posts per repo.md requirements
        if ($user->hasRole('contributor')) {
            return false;
        }

        if ($user->hasRole('admin')) {
            return true;
        }

        if ($user->hasRole('editor') && $post->user_id === $user->id) {
            return true;
        }

        return false;
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return $user->hasRole('admin');
    }
}