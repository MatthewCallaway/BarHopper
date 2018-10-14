<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'gender','birthday', 'username','created_at','updated_at'
    ];
}
