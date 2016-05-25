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
 * @website http://www.laralabs.uk/
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

    const PASSED = 1;
    const FAILED = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'director_id', 'name', 'driver', 'host', 'port', 'database', 'username', 'password', 'charset', 'collation', 'prefix', 'strict', 'schema', 'engine', 'status'
    ];

    /**
     * Find Catalog by ID
     *
     * @param $id
     * @return mixed
     */
    public static function find($id) {

        $catalogs = Catalogs::where('id', $id)->get();

        foreach($catalogs as $catalog)
        {
            return $catalog;
        }
    }

    /**
     * Get Director Catalog by Director ID
     *
     * @param $director_id
     * @return mixed
     */
    public static function getDirectorCatalog($director_id)
    {
        $catalogs = Catalogs::where('director_id', $director_id)->get();

        foreach($catalogs as $catalog)
        {
            return $catalog;
        }
    }

    /**
     * Get Catalog Name for given Catalog ID
     *
     * @param $id
     * @return mixed
     */
    public static function getCatalogName($id)
    {
        $catalogs = Catalogs::where('id', $id)->get();

        foreach($catalogs as $catalog)
        {
            return $catalog->name;
        }
    }

    /**
     * Get Catalog's Status and return boolean
     *
     * @param $director_id
     * @return bool
     */
    public static function getCatalogConnectionStatus($director_id)
    {
        $catalogs = Catalogs::where('director_id', $director_id)->get();

        foreach($catalogs as $catalog)
        {
            $status = $catalog->status;

            if($status == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
}
