<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Schedules Options Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchedulesOptions extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'schedules_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'name', 'display_name'
    ];

    /**
     * Find schedule option record by given id
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $schedulesoptions = SchedulesOptions::where('id', $id)->get();

        foreach($schedulesoptions as $scheduleoption)
        {
            return $scheduleoption;
        }
    }

    public static function getName($id)
    {
        $schedulesoptions = SchedulesOptions::where('id', $id)->get();

        foreach($schedulesoptions as $scheduleoption)
        {
            return $scheduleoption->display_name;
        }
    }

    public static function getReadableAddFreq($data)
    {
        $add_frequencies = unserialize($data);

        $string = '';

        foreach($add_frequencies as $add_frequency)
        {
            $name = SchedulesOptions::getName($add_frequency);

            $string = $string.' '.$name;
        }

        return $string;
    }
}
