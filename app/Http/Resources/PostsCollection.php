<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($post) {
            return [
                'id' => $post->id,
                'content' => $post->content,
                'image' => $post->image,
                'created_at' => $post->created_at->format('Y-m-d'),
                'user' => [
                    'id' => $post->users->id,
                    'name' => $post->users->name,
                    'avatar' => $post->users->avatar,
                ],
                // 'user' => new UserResource($post->users()->get()),

                'comments' => $post->comments->map(function ($comment) {

                    return [
                        'id' => $comment->id,
                        'content' => $comment->content,
                        'created_at' => $comment->created_at->format('Y-m-d'),
                        // 'user' => new UserResource($comment->user()->get())
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                            'avatar' => $comment->user->avatar,
                        ],
                    ];
                }),
                'likes' => $post->likes->pluck('user_id'),
            ];
        });
    }
}
