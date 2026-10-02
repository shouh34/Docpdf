<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TopController extends Controller
{
    //


    public function top()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
            }
            return view("top"); // パスを変更
    }




    //ログイン画面の表示
    public function Login()
    {

    return view("auth.login");
    }



}
