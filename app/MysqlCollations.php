<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * MysqlCollations Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
 */

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
