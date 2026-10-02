<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

    public function markAsRead(string $notification)
    {
        $user = Auth::user();

        $user->unreadNotifications()
            ->where('id', $notification)
            ->firstOrFail()
            ->markAsRead();

        return back()->with('success', '通知を既読にしました。');
    }
}
