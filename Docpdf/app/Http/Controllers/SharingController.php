<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents;
use Exception;
use App\Models\User;


class SharingController extends Controller
{
    //



    public function index($id)
    {


    return view ("documents.share",compact('id'));
    }




}
