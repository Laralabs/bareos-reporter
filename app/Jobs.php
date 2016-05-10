<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Jobs Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'director_id', 'schedule_id', 'clients', 'template_id', 'contacts'
    ];

    /**
     * Find job record by given id
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $jobs = Jobs::where('id', $id)->get();

        foreach($jobs as $job)
        {
            return $job;
        }
    }
}
