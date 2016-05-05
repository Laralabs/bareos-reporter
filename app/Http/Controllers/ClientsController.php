<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Clients Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
 */

namespace App\Http\Controllers;

use App\Directors;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        /**
         * Add the Director Check Middleware
         */
        $this->middleware('director');
    }

    /**
     * Show the director clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeDirector = Session::get('active_director');
        $activeConnection = Session::get('active_connection');
        $director = Directors::find($activeDirector);

        $clients = DB::connection($activeConnection)->table('Client')->get();

        return view('clients.index', ['director' => $director, 'clients' => $clients]);
    }
}
