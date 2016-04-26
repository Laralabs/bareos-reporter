<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MysqlCollations extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'mysql_collations';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'COLLATION_NAME', 'CHARACTER_SET_NAME', 'ID', 'SORTLEN'
    ];

    public static function getCollationFromCharset($charset)
    {
        $collations = MysqlCollations::where('CHARACTER_SET_NAME', $charset)->get();

        return $collations;
    }
}
