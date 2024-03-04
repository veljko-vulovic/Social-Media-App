<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsCollection;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    function show(User $user)
    {
        $auth = Auth::user();
        $post = Post::with(['users', 'likes', 'comments'])
            ->orderBy('created_at', 'DESC')
            ->where('user_id', $user->id)
            ->get();

        $isFollowed = $auth->following->contains('id', $user->id);

        return Inertia::render('User/Show', [
            'user' => new UserResource($user),
            'posts' => new PostsCollection($post),
            'isFollowed' => $isFollowed
        ]);
    }
}
