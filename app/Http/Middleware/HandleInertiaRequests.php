<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user() ?? null;

        // $followers = $request->user()->following()->pluck('following_id');
        $followers = $user ? $user->following()->pluck('following_id') : [];


        return [
            ...parent::share($request),
            'auth' => [
                // 'user' => new UserResource($user),
                'user' => $user,
            ],

            'randomUsers' => User::with('following')->inRandomOrder()
                ->where('id', '!=', Auth::id())
                ->whereNotIn('id', $followers)
                ->take(3)->get()->map(function ($user) {
                    return  [
                        'id' => $user->id,
                        'name' => $user->name,
                        'avatar' => $user->avatar
                    ];
                })

        ];
    }
}
