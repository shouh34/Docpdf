<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Exception;

class AccountController extends Controller
{
    public function updateProfileImage(Request $request)
    {

        try
        {
            $request->validate([
                'profile_image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ]);

            $user = Auth::user();

            // 古い画像を削除
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // 新しい画像を保存
            $path = $request->file('profile_image')
                ->store('profile_images', 'public');

            // DBにパスを保存
            $user->profile_image = $path;
            $user->save();

            return back()->with(
                'success',
                'プロフィール画像を更新しました。'
            );
        }
        catch(\Exception $e)
        {

        }
    }


    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        $user->save();

        return back()->with(
            'success',
            'アカウント情報を更新しました。'
        );
    }
}
