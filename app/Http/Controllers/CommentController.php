<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->get('post_id');
        $comment->content = $request->get('comment');

        $comment->save();
    }

    public function destroy(Request $request, Comment $comment)
    {
        $com○☼ment = Comment::find($request->get('id'));
        $comment->delete();
    }
}
