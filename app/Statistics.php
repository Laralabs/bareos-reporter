<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Statistics Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class Statistics extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'statistics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_count', 'emails_sent', 'invalid_contacts', 'invalid_catalogs'
    ];

    /**
     * Return statistics record
     *
     * @return mixed
     */
    public static function getStatistics()
    {
        $statistics = Statistics::all()->first();

        if($statistics == null)
        {
            $statistics = new Statistics();
        }

        return $statistics;
    }

    /**
     * Increment job_count by one
     *
     */
    public static function jobIncrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->increment('job_count');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 1,
                'emails_sent'       => 0,
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => 0
            ]);
        }
    }

    /**
     * Decrememt job_count by one
     *
     */
    public static function jobDecrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->decrement('job_count');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => 0,
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => 0
            ]);
        }
    }

    /**
     * Increment email_count by one
     *
     */
    public static function emailIncrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->increment('emails_sent');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => 1,
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => 0
            ]);
        }
    }

    /**
     * Decrement email_count by one
     *
     */
    public static function emailDecrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->decrement('emails_sent');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => 0,
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => 0
            ]);
        }
    }

    /**
     * Increment invalid_contacts by one
     *
     */
    public static function invalidContactIncrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->increment('invalid_contacts');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => 0,
                'invalid_contacts'  => 1,
                'invalid_catalogs'  => 0
            ]);
        }
    }

    /**
     * Decrement invalid_contacts by one
     *
     */
    public static function invalidContactDecrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->decrement('invalid_contacts');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => 0,
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => 0
            ]);
        }
    }

    /**
     * Increment invalid_catalogs by one
     *
     */
    public static function invalidCatalogIncrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->increment('invalid_catalogs');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => 0,
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => 1
            ]);
        }
    }

    /**
     * Decrement invalid_catalogs by one
     *
     */
    public static function invalidCatalogDecrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $statistic->decrement('invalid_catalogs');
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => 0,
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => 0
            ]);
        }
    }

    /**
     * Get the Invalid Contacts count
     *
     * @return integer
     * @return null
     */
    public static function getInvalidContactCount()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            return $statistic->invalid_contacts;
        }
        else
        {
            return null;
        }
    }

    /**
     * Counts invalid contacts and updates statistic
     *
     */
    public static function updateInvalidContactCount()
    {
        $contacts = Contacts::all()->where('valid', Contacts::INVALID);
        $setting = Statistics::getStatistics();

        if($contacts)
        {
            $contactCount = $contacts->count();
            $setting->invalid_contacts = $contactCount;
            try{
                $setting->save();
            }catch (Exception $e){
                $error = $e->getMessage();
                Log::error('updateInvalidContactCount() ERROR: .'.$error);
            }
        }
    }

    /**
     * Counts invalid catalogs and updates statistic
     *
     */
    public static function updateInvalidCatalogCount()
    {
        $catalogs = Catalogs::all()->where('status', Catalogs::FAILED);
        $setting = Statistics::getStatistics();

        if($catalogs){
            $catalogCount = $catalogs->count();
            $setting->invalid_catalogs = $catalogCount;
            try{
                $setting->save();
            }catch (Exception $e){
                $error = $e->getMessage();
                Log::error('updateInvalidCatalogCount() ERROR: .'.$error);
            }
        }
    }
}
