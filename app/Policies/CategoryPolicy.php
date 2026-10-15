<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('contributor');
    }

    public function view(User $user, Category $category): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor') || $user->hasRole('contributor');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Category $category): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Category $category): bool
    {
        return $user->hasRole('admin');
    }
}