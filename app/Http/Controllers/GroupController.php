<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsCollection;
use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class GroupController extends Controller
{

    public function index(Request $request)
    {

        $userGroupsIds = $request->user()->groups()->pluck('group_id')->toArray();
        // dd($userGroupsIds);
        return Inertia::render('Group/Index', [
            'groups' => Group::whenLoaded('users')->get(),
            'userGroupsIds' => $userGroupsIds,
        ]);
    }

    public function show(Request $request, Group $group)
    {
        $userGroupsIds = $request->user()->groups()->pluck('group_id')->toArray();

        $post = Post::whenLoaded(['users', 'likes', 'comments'])
        ->orderBy('created_at', 'DESC')
        ->whereIn('user_id', [...$userGroupsIds])
        ->get();
        return Inertia::render('Group/Show', [
            'group' => $group->load('users'),
            'userGroupsIds' => $userGroupsIds,
            'posts' => new PostsCollection($post),
        ]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required',
            'group_id' => [
                'required',
                Rule::unique('group_users')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user_id);
                }),
            ],

        ]);

        $user = User::find($validatedData['user_id']);
        $group = Group::find($validatedData['group_id']);

        $user->groups()->attach($group);

        return Redirect::route('group.index')->withMessage('success', 'User joined group successfully.');
    }

    public function destroy(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required',
            'group_id' =>
            'required',
        ]);

        $user = User::find($validatedData['user_id']);
        $group = Group::find($validatedData['group_id']);

        $user->groups()->detach($group);

        return Redirect::route('group.index')->withMessage('success', 'User left group.');
    }
}
