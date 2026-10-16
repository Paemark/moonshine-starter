<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        // Validation and Authorization have already passed.
        // DB::transaction ensures data integrity for multi-table/state changes.
        $post = DB::transaction(function () use ($request) {
            $data = $request->validated();
            
            // Enforce that the authenticated user is the author
            $data['user_id'] = Auth::id();

            return Post::create($data);
        });

        return redirect()->route('posts.show', $post)
            ->with('status', 'Post created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        // Validation and IDOR prevention (via $request->authorize()) have already passed.
        $post->update($request->validated());

        return redirect()->route('posts.show', $post)
            ->with('status', 'Post updated successfully.');
    }
}