<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'image' => 'image|nullable',
        ]);
        // dd($validatedData);

        $user = auth()->user();
        $post = new Post();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $validatedData['image'] = $filename;
            $post->image = 'images/' . $filename;
        }

        $post->user_id = $user->id;
        $post->content = $validatedData['content'];
        // dd($post);
        $post->save();

        return redirect(route('dashboard'));
    }


    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        // dd($request->user(), $post->users);
        if ($request->user() == $post->users) {

            if (File::exists(public_path($post->image))) {
                $deleted = File::delete(public_path($post->image));
            } else {
                dd('File does not exist.');
            }

            Post::destroy($request->id);
        }

        return Redirect::route('dashboard');
    }
}
