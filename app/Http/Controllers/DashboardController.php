<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Dashboard Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Http\Controllers;

use App\Catalogs;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Change the active director, set active_director
     * session variable if input value not empty.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeDirector()
    {
        $director_id = Input::get('director-select');

        if(!empty($director_id))
        {
            $connectionName = Catalogs::getCatalogName($director_id);

            Session::set('active_connection', $connectionName);
            Session::set('active_director', $director_id);

            return redirect('directors')->with('success', 'Director changed successfully');
        }
        else
        {
            return redirect('directors')->with('error', 'Unable to change director');
        }
    }
}
