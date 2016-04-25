<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directors extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'director_name', 'ip_address', 'dir_password', 'catalog_id'
    ];

    public static function find($id) {

        $directors = Directors::where('id', $id)->get();

        foreach($directors as $director)
        {
            return $director;
        }
    }
}
