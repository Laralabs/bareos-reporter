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
        $host               =   array_filter(Input::get('host'));
        $port               =   array_filter(Input::get('port'));
        $database           =   array_filter(Input::get('database'));
        $username           =   array_filter(Input::get('username'));
        $password           =   array_filter(Input::get('password'));
        if(!empty($password))
        {
            $enc_password   =   Crypt::encrypt($password);
        }
        else
        {
            $enc_password   =   '';
        }
        $enc_password       =   Crypt::encrypt($password);
        $charset            =   array_filter(Input::get('charset'));
        $collation          =   array_filter(Input::get('collation'));
        $prefix             =   array_filter(Input::get('prefix'));
        if(empty($prefix))
        {
            $prefix         =   '';
        }
        else
        {
            $prefix         =   $prefix[0];
        }
        $strict             =   array_filter(Input::get('strict'));
        $engine             =   Input::get('engine');
        $schema             =   Input::get('schema');

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
                    $catalog = Catalogs::create(array(
                        'director_id'       =>  $director_id,
                        'name'              =>  $catalog_name,
                        'driver'            =>  $driver,
                        'host'              =>  $host[0],
                        'port'              =>  $port[0],
                        'database'          =>  $database[0],
                        'username'          =>  $username[0],
                        'password'          =>  $enc_password,
                        'charset'           =>  $charset[0],
                        'collation'         =>  $collation[0],
                        'prefix'            =>  $prefix,
                        'strict'            =>  $strict[0],
                        'engine'            =>  $engine
                    ));

                    $catalog->save();

                    $director = Directors::find($director_id);

                    $director->catalog_id = $catalog->id;
                    $director->save();
                }
                elseif($driver == 'pgsql')
                {

                }
                elseif($driver == 'sqlsrv')
                {
                    
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
