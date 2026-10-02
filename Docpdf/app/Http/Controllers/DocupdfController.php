<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocupdfController extends Controller
{
    //


    public function index()
    {

    return view ("edit");

    }


    //ドキュメントの保存処理
    public function SaveDocument()
    {


    return "保存しました";

    }
}
