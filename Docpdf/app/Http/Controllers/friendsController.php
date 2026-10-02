<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class friendsController extends Controller
{
    //

    public function index(Request $request)
    {
        $userId = (int) $request->user()->getAuthIdentifier();

        $friendIds = DB::table('friendships')
            ->where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhere('friend_id', $userId);
            })
            ->get(['user_id', 'friend_id'])
            ->map(fn ($friendship) =>
                (int) $friendship->user_id === $userId
                    ? $friendship->friend_id
                    : $friendship->user_id
            );

        $friends = User::whereIn('id', $friendIds)
            ->orderBy('name')
            ->get(['id', 'name', 'email']);
            // 既存の書類や通知なども、このviewへ一緒に渡してください
        return view('dashboard', compact(
            'documentCount',
            'monthlyDocumentCount',
            'notifications',
            'recentDocuments',
            'friends'
        ));

        }


        public function store()
        {



        }
}
