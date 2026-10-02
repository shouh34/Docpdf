<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FriendController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $friendships = Friendship::where('status', 'accepted')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('friend_id', $user->id);
            })
            ->get();

        $friendIds = $friendships->map(function ($friendship) use ($user) {
            return $friendship->user_id == $user->id
                ? $friendship->friend_id
                : $friendship->user_id;
        });

        $friends = User::whereIn('id', $friendIds)->get();

        $receivedRequests = Friendship::where('friend_id', $user->id)
            ->where('status', 'pending')
            ->with('requester')
            ->get();

        return view('friends.index', compact('friends', 'receivedRequests'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $friend = User::where('email', $validated['email'])->first();

        if (!$friend) {
            return back()->withErrors(['email' => '該当するユーザーが見つかりません。']);
        }

        if ((int) $friend->id === (int) Auth::id()) {
            return back()->withErrors([
                'email' => '自分自身には申請できません。',
                ]);
        }
        $alreadyExists = Friendship::where(function ($query) use ($friend) {
            $query->where('user_id', Auth::id())
                ->where('friend_id', $friend->id);
        })->orWhere(function ($query) use ($friend) {
            $query->where('user_id', $friend->id)
                ->where('friend_id', Auth::id());
        })->exists();

        if ($alreadyExists) {
            return back()->withErrors([
                'email' => '申請済み、またはすでに友達です。',
            ]);
        }

        Friendship::create([
            'user_id' => Auth::id(),
            'friend_id' => $friend->id,
            'requested_by' => Auth::id(),
            'status' => 'pending',
        ]);

        return back()->with('success', '友達申請を送りました。');
    }

    public function accept(Friendship $friendship)
    {
        // E-07：申請の受取人以外は承認できない
        abort_unless(
            (int) $friendship->friend_id === (int) Auth::id(),
            403
        );

        // E-08：pending以外は再承認できない
        if ($friendship->status !== 'pending') {
            return back()->withErrors([
                'friendship' => 'この申請はすでに処理されています。',
            ]);
        }

        $friendship->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return back()->with('success', '友達申請を承認しました。');

    }

    public function documents()
    {
        
    }
}
