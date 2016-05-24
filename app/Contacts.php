<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Contacts Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'valid'
    ];

    const INVALID = 0;
    const VALID = 1;

    /**
     * Find contact record by given id
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $contacts = Contacts::where('id', $id)->get();

        foreach($contacts as $contact)
        {
            return $contact;
        }
    }
}
