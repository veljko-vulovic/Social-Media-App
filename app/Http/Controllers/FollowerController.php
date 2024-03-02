<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class FollowerController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Followers', [
            'followers' => $request->user()->following()->get()
        ]);
    }
    public function store(Request $request)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'follower_id' => 'required',
            'following_id' => [
                'required',
                Rule::unique('followers')->where(function ($query) use ($request) {
                    return $query->where('follower_id', $request->follower_id);
                }),
            ],
        ]);

        $follower = new Follower();
        $follower->follower_id = $validatedData['follower_id'];
        $follower->following_id = $validatedData['following_id'];

        $follower->save();

        // return Redirect::refresh()->withMessage('success', 'User followed successfully.');
    }


    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'follower_id' => 'required',
            'following_id' => 'required',
        ]);

        $follower = Follower::where('following_id', $validatedData['following_id'])->where('follower_id', $validatedData['follower_id'])->first();
        // dd($follower);
        $follower->delete();

        return Redirect::back()->withMessage('success','User deleted');
    }
}
