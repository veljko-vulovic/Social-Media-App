<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $user = $request->user();
        // $followers = $request->user()->with('following')->get()->pluck('following')->flatten()->pluck('id')->toArray();

        // dd([...$followers,$user->id]);
        // $followers = $user ? $user->following()->pluck('following_id') : [];

        $post = Post::
            orderBy('created_at', 'DESC')
            // ->whereIn('user_id', [...$followers, $user->id])
            ->get();

            $userGroups = Auth::user()->groups ;

        return Inertia::render('Home', [
            'posts' => new PostsCollection($post->load(['users', 'likes', 'comments'])),
            'userGroups' =>  $userGroups,
        ]);
    }
}
