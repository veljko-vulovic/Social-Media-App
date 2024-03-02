<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
        ]);


        $user = auth()->user();

        $like = Like::where('post_id',  $validatedData['post_id'])
            ->where('user_id', $user->id)
            ->first();
        if ($like) {
            return redirect(route('dashboard'));
        } else {
            $like = Like::create([
                'user_id' => $user->id,
                'post_id' => $validatedData['post_id'],
            ]);
        }
    }


    public function destroy(Request $request)
    {
        $post = Post::find($request->get('post_id'));
        $user = Auth::user();
        $like = Like::where(['user_id' => $user->id, 'post_id' => $post->id])->first();

        if ($like) {
            $like->delete();
        }
    }
}
