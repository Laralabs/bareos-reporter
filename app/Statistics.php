<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * Increment job_count by one
     *
     */
    public static function jobIncrement()
    {
        $statistic = Statistics::all()->first();

        if($statistic)
        {
            $jobCount = $statistic->job_count;
            $statistic->job_count = $jobCount++;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 1,
                'emails_sent'       => '',
                'invalid_contacts'  => '',
                'invalid_catalogs'  => ''
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
            $jobCount = $statistic->job_count;
            $statistic->job_count = $jobCount--;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => 0,
                'emails_sent'       => '',
                'invalid_contacts'  => '',
                'invalid_catalogs'  => ''
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
            $emailsSent = $statistic->emails_sent;
            $statistic->emails_sent = $emailsSent++;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => '',
                'emails_sent'       => 1,
                'invalid_contacts'  => '',
                'invalid_catalogs'  => ''
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
            $emailsSent = $statistic->emails_sent;
            $statistic->emails_sent = $emailsSent--;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => '',
                'emails_sent'       => 0,
                'invalid_contacts'  => '',
                'invalid_catalogs'  => ''
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
            $invalidContacts = $statistic->invalid_contacts;
            $statistic->invalid_contacts = $invalidContacts++;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => '',
                'emails_sent'       => '',
                'invalid_contacts'  => 1,
                'invalid_catalogs'  => ''
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
            $invalidContacts = $statistic->invalid_contacts;
            $statistic->invalid_contacts = $invalidContacts--;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => '',
                'emails_sent'       => '',
                'invalid_contacts'  => 0,
                'invalid_catalogs'  => ''
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
            $invalidCatalogs = $statistic->invalid_catalogs;
            $statistic->invalid_catalogs = $invalidCatalogs++;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => '',
                'emails_sent'       => '',
                'invalid_contacts'  => '',
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
            $invalidCatalogs = $statistic->invalid_catalogs;
            $statistic->invalid_catalogs = $invalidCatalogs--;
            $statistic->save();
        }
        else
        {
            $statistic = Statistics::create([
                'job_count'         => '',
                'emails_sent'       => '',
                'invalid_contacts'  => '',
                'invalid_catalogs'  => 0
            ]);
        }
    }
}
