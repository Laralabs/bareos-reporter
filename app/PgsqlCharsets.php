<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * PgsqlCharsets Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

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
