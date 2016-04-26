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

use App\Directors;
use App\MysqlCollations;
use App\PgsqlCharsets;
use Illuminate\Http\Request;

use App\Http\Requests;
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

        return view('directors.edit', ['director' => $director]);
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
        $dir_ip_address     =   Input::get('ip_address');
        $director_port      =   Input::get('director_port');

        // Catalog Details
        $driver             =   Input::get('driver');
        $host               =   Input::get('port');
        $database           =   Input::get('database');
        $username           =   Input::get('username');
        $password           =   Input::get('password');
        $charset            =   Input::get('charset');
        $collation          =   Input::get('collation');
        $prefix             =   Input::get('prefix');
        $strict             =   Input::get('strict');
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
