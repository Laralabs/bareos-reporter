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
        'name', 'status', 'director_id', 'schedule_id', 'report_type', 'clients', 'template_id', 'contacts'
    ];

    const REPORT_TYPE_ALL       =   1;
    const REPORT_TYPE_SEPARATE  =   2;
    const JOB_ENABLED           =   1;
    const JOB_DISABLED          =   2;

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

    /**
     * Get job status. Return boolean.
     *
     * @param $id
     * @return bool
     */
    public static function getJobStatus($id)
    {
        $job = Jobs::find($id);

        if($job->status == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
