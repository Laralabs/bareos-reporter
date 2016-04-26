<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PgsqlCharsets extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'pgsql_charsets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
