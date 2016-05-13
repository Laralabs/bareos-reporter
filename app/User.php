<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Find user record by given id
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $users = User::where('id', $id)->get();

        foreach($users as $user)
        {
            return $user;
        }
    }
}
