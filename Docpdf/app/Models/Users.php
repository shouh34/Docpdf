<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //


    protected $table = 'users';


    protected $fillable =[
        'name',
        'email',
        'profile_image',
        'password',
        'profile_image',
        ];

    protected $hidden =[
        'password',
         'remember_token',
         ];


}
