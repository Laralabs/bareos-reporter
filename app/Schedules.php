<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Schedules Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'schedules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'freq', 'add_freq', 'time'
    ];

    /**
     * Find schedule record by given id
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $schedules = Schedules::where('id', $id)->get();

        foreach($schedules as $schedule)
        {
            return $schedule;
        }
    }

    public static function getScheduleName($id)
    {
        $schedule = Schedules::find($id);

        return $schedule->name;
    }
}
