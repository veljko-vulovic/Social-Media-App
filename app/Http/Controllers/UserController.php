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

    function posts(User $user)
    {
        $posts =  $user->posts;
        return Inertia::render('User/Posts', [
            'posts' => new PostsCollection($posts),
        ]);
    }

    function comments(User $user)
    {
        $comments =  $user->comments->pluck('post_id')->toArray();
        $comments =  array_unique($comments);
        $posts = Post::where('id', $comments)->get();
        return Inertia::render('User/Posts', [
            'posts' => new PostsCollection($posts),
        ]);
    }

    function likes(User $user)
    {
        $likes =  $user->liked->pluck('post_id')->toArray();
        $likes =  array_unique($likes);
        $posts = Post::where('id', $likes)->get();
        return Inertia::render('User/Posts', [
            'posts' => new PostsCollection($posts),
        ]);
    }
}
