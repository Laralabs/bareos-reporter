<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Directors Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 */

namespace App\Http\Controllers;

use App\Catalogs;
use App\Directors;
use App\MysqlCollations;
use App\PgsqlCharsets;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class DirectorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the directors
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors = Directors::all();

        return view('directors.index', ['directors' => $directors]);
    }

    /**
     * Add a director
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $mysql_collations = MysqlCollations::all()->sortByDesc('SORTLEN');
        $mysql_charsets = MysqlCollations::all()->sortByDesc('SORTLEN')->unique('CHARACTER_SET_NAME');
        $pgsql_charsets = PgsqlCharsets::all();

        return view('directors.add', ['mysql_collations' => $mysql_collations, 'mysql_charsets' => $mysql_charsets, 'pgsql_charsets' => $pgsql_charsets]);
    }

    /**
     * Edit a director
     *
     * @param \App\Directors $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $director = Directors::find($id);
        $catalog = Catalogs::getDirectorCatalog($id);

        $mysql_collations = MysqlCollations::all()->sortByDesc('SORTLEN');
        $mysql_charsets = MysqlCollations::all()->sortByDesc('SORTLEN')->unique('CHARACTER_SET_NAME');
        $pgsql_charsets = PgsqlCharsets::all();

        return view('directors.edit', ['director' => $director, 'catalog' => $catalog, 'mysql_collations' => $mysql_collations, 'mysql_charsets' => $mysql_charsets, 'pgsql_charsets' => $pgsql_charsets]);
    }

    /**
     * Create a director
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Director Details
        $director_name      =   Input::get('director_name');
        $dir_ip_address     =   Input::get('director_ip');
        $director_port      =   Input::get('director_port');

        // Catalog Details
        $catalog_name       =   Input::get('catalog_name');
        $driver             =   Input::get('driver');
        $engine             =   Input::get('engine');

        if(!empty($director_name) && !empty($dir_ip_address) && !empty($director_port))
        {
            try{
                $director = Directors::create(array(
                    'director_name'     =>  $director_name,
                    'ip_address'        =>  $dir_ip_address,
                    'director_port'     =>  $director_port
                ));

                $director->save();
                $director_id = $director->id;

                if($driver == 'mysql')
                {
                    $host = Input::get('host-mysql');
                    $port = Input::get('port-mysql');
                    $database = Input::get('database-mysql');
                    $username = Input::get('username-mysql');
                    $password = Input::get('password-mysql');
                    if(!empty($password))
                    {
                        $enc_password = Crypt::encrypt($password);
                    }
                    else
                    {
                        $enc_password = '';
                    }
                    $charset = Input::get('charset-mysql');
                    $collation = Input::get('collation-mysql');
                    $prefix = Input::get('prefix-mysql');
                    $strict = Input::get('strict-mysql');

                    $catalog = Catalogs::create(array(
                        'director_id'       =>  $director_id,
                        'name'              =>  $catalog_name,
                        'driver'            =>  $driver,
                        'host'              =>  $host,
                        'port'              =>  $port,
                        'database'          =>  $database,
                        'username'          =>  $username,
                        'password'          =>  $enc_password,
                        'charset'           =>  $charset,
                        'collation'         =>  $collation,
                        'prefix'            =>  $prefix,
                        'strict'            =>  $strict,
                        'schema'            =>  '',
                        'engine'            =>  $engine
                    ));

                    $catalog->save();

                    $director = Directors::find($director_id);

                    $director->catalog_id = $catalog->id;
                    $director->save();
                }
                elseif($driver == 'pgsql')
                {
                    $host = Input::get('host-pgsql');
                    $port = Input::get('port-pgsql');
                    $database = Input::get('database-pgsql');
                    $username = Input::get('username-pgsql');
                    $password = Input::get('password-pgsql');
                    if(!empty($password))
                    {
                        $enc_password = Crypt::encrypt($password);
                    }
                    else
                    {
                        $enc_password = '';
                    }
                    $charset = Input::get('charset-pgsql');
                    $prefix = Input::get('prefix-pgsql');
                    $schema = Input::get('schema-pgsql');

                    $catalog = Catalogs::create(array(
                        'director_id'       =>  $director_id,
                        'name'              =>  $catalog_name,
                        'driver'            =>  $driver,
                        'host'              =>  $host,
                        'port'              =>  $port,
                        'database'          =>  $database,
                        'username'          =>  $username,
                        'password'          =>  $enc_password,
                        'charset'           =>  $charset,
                        'collation'         =>  '',
                        'prefix'            =>  $prefix,
                        'strict'            =>  '',
                        'schema'            =>  $schema,
                        'engine'            =>  $engine
                    ));

                    $catalog->save();

                    $director = Directors::find($director_id);

                    $director->catalog_id = $catalog->id;
                    $director->save();
                }
                elseif($driver == 'sqlite')
                {
                    $database = Input::get('database-sqlite');
                    $prefix = Input::get('prefix-sqlite');

                    $catalog = Catalogs::create(array(
                        'director_id'       =>  $director_id,
                        'name'              =>  $catalog_name,
                        'driver'            =>  $driver,
                        'host'              =>  '',
                        'port'              =>  '',
                        'database'          =>  $database,
                        'username'          =>  '',
                        'password'          =>  '',
                        'charset'           =>  '',
                        'collation'         =>  '',
                        'prefix'            =>  $prefix,
                        'strict'            =>  '',
                        'schema'            =>  '',
                        'engine'            =>  ''
                    ));

                    $catalog->save();

                    $director = Directors::find($director_id);

                    $director->catalog_id = $catalog->id;
                    $director->save();
                }
                else
                {
                    return redirect('directors')->with('error', 'Invalid catalog driver');
                }

            }catch (Exception $e)
            {
                return redirect('directors')->with('error', 'Failed to create director.');
            }
        };

        return redirect('directors')->with('success', 'Director saved successfully.');
    }

    /**
     * Save an edited director
     *
     * @param \App\Directors $id
     * @return \Illuminate\Http\Response
     */
    public function save($id)
    {
        $director = Directors::find($id);

        return redirect('directors')->with('success', 'Director saved successfully.');
    }
}
