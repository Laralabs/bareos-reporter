<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Settings Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_from_address', 'email_from_name'
    ];

    /**
     * Find setting record by given id
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $settings = Settings::where('id', $id)->get();

        foreach($settings as $setting)
        {
            return $setting;
        }
    }

    /**
     * Return settings record
     *
     * @return mixed
     */
    public static function getSettings()
    {
        $settings = Settings::all()->first();

        if($settings == null)
        {
            $settings = new Settings();
        }

        return $settings;
    }

    /**
     * Return Email From Address
     *
     * @return mixed
     */
    public static function getEmailFromAddress()
    {
        $settings = Settings::all()->first();

        if($settings == null)
        {
            $settings = new Settings();
        }

        return $settings->email_from_address;
    }

    /**
     * Return Email From Name
     *
     * @return mixed
     */
    public static function getEmailFromName()
    {
        $settings = Settings::all()->first();

        if($settings == null)
        {
            $settings = new Settings();
        }

        return $settings->email_from_name;
    }
}
