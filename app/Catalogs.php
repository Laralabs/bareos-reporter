<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Catalogs Model
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogs extends Model
{
    /**
     * The table associated to model
     *
     * @var string
     */
    protected $table = 'catalogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'director_id', 'name', 'driver', 'host', 'port', 'database', 'username', 'password', 'charset', 'collation', 'prefix', 'strict', 'engine'
    ];

    public static function find($id) {

        $catalogs = Catalogs::where('id', $id)->get();

        foreach($catalogs as $catalog)
        {
            return $catalog;
        }
    }

    public static function getDirectorCatalog($director_id)
    {
        $catalogs = Catalogs::where('director_id', $director_id)->get();

        foreach($catalogs as $catalog)
        {
            return $catalog;
        }
    }

    public static function getCatalogName($id)
    {
        $catalogs = Catalogs::where('id', $id)->get();

        foreach($catalogs as $catalog)
        {
            return $catalog->name;
        }
    }
}
