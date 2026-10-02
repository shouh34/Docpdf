<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountSettingsController extends Controller
{
    //

        public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.current_password' => '現在のパスワードが正しくありません。',
            'password.confirmed' => '新しいパスワードが一致しません。',
        ]);

        $user = Auth::user();
        $user->password = $validated['password'];
        $user->save();

        return back()->with('success', 'パスワードを変更しました。');
    }

}
