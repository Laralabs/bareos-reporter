<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Jobs Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Http\Controllers;

use App\Catalogs;
use App\Contacts;
use App\Directors;
use App\Jobs;
use App\Schedules;
use App\Templates;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
     * Show Director Jobs
     *
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        $director = Directors::find($id);
        $connection_name = Session::get('active_connection');
        $jobs = Jobs::all();
        $clients = '';

        if($connection_name)
        {
            $clients = DB::connection($connection_name)->table('Client')->get();
        }
        else
        {
            $connection_name = Catalogs::getCatalogName($id);
            $clients = DB::connection($connection_name)->table('Client')->get();
        }

        return view('jobs.index', ['director' => $director, 'clients' => $clients, 'jobs' => $jobs]);
    }

    /**
     * Add Director Job View
     *
     * @param $id
     * @return mixed
     */
    public static function add($id)
    {
        $director = Directors::find($id);
        $schedules = Schedules::all();
        $connection_name = Session::get('active_connection');
        $clients = '';
        if($connection_name)
        {
            $clients = DB::connection($connection_name)->table('Client')->get();
        }
        else
        {
            $connection_name = Catalogs::getCatalogName($id);
            $clients = DB::connection($connection_name)->table('Client')->get();
        }
        $templates = Templates::all();
        $contacts = Contacts::all();

        return view('jobs.add', ['director' => $director, 'schedules' => $schedules, 'clients' => $clients, 'templates' => $templates, 'contacts' => $contacts]);
    }

    public static function create($id)
    {
        $name = Input::get('name');
        $schedule = Input::get('schedule');
        $clients_input = Input::get('clients');
        $template = Input::get('template');
        $contacts = Input::get('contacts');
        $clients = array();

        $redirectUrl = '/jobs/'.$id;

        if(!empty($name))
        {
            foreach($clients_input as $client_input)
            {
                $bareosClients = DB::connection(Catalogs::getCatalogName($id))->table('Client')->where('ClientId', '=', $client_input)->get();

                foreach($bareosClients as $bareosClient)
                {
                    $client = array(
                        'id'        =>  $client_input,
                        'name'      =>  $bareosClient->Name
                    );
                    array_push($clients, $client);
                }
            }
            $clients = json_encode($clients);
            $contacts = json_encode($contacts);

            try {
                $job = Jobs::create(array(
                    'name'          =>  $name,
                    'director_id'   =>  $id,
                    'schedule_id'   =>  $schedule,
                    'clients'       =>  $clients,
                    'template_id'   =>  $template,
                    'contacts'      =>  $contacts
                ));

                return redirect($redirectUrl)->with('success', 'Job created successfully');
            }catch(Exception $e)
            {
                return redirect()->back()->with('error', 'Unable to create job');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Please input a name');
        }
    }
}
