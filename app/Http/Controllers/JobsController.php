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

    /**
     * Create job
     *
     * @param $id
     * @return mixed
     */
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
            $contactsFull = [];
            foreach($contacts as $contact)
            {
                $contactRecord = Contacts::find($contact);
                $contactArray = [
                    'id'        =>  $contactRecord->id,
                    'name'      =>  $contactRecord->name,
                    'email'     =>  $contactRecord->email,
                    'mobile'    =>  $contactRecord->mobile
                ];

                array_push($contactsFull, $contactArray);
            }
            $contacts = json_encode($contactsFull);

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

    /**
     * Edit Job View
     *
     * @param $director
     * @param $id
     * @return mixed
     */
    public function edit($director, $id)
    {
        $job = Jobs::find($id);
        $director = Directors::find($director);
        $schedules = Schedules::all();
        $templates = Templates::all();
        $connection_name = Session::get('active_connection');
        $clients = '';
        if($connection_name)
        {
            $clients = DB::connection($connection_name)->table('Client');
        }
        else
        {
            $connection_name = Catalogs::getCatalogName($director);
            $clients = DB::connection($connection_name)->table('Client');
        }
        $jobClients = json_decode($job->clients);
        foreach($jobClients as $jobClient)
        {
            $clients = $clients->where('ClientId', '!=', $jobClient->id);
        }
        $clients = $clients->get();
        $contacts = Contacts::all();
        $jobContacts = json_decode($job->contacts);
        foreach($jobContacts as $jobContact)
        {
            $contacts = $contacts->where('id', '!=', $jobContact->id);
        }

        return view('jobs.edit', ['job' => $job, 'director' => $director, 'schedules' => $schedules, 'clients' => $clients, 'templates' => $templates, 'contacts' => $contacts]);
    }

    /**
     * Save Job
     *
     * @param $director
     * @param $id
     * @return mixed
     */
    public function save($director, $id)
    {
        $job = Jobs::find($id);
        $name = Input::get('name');
        $schedule = Input::get('schedule');
        $clients_input = Input::get('clients');
        $template = Input::get('template');
        $contacts = Input::get('contacts');
        $clients = array();

        $redirectUrl = '/jobs/'.$director;

        if(!empty($name))
        {
            foreach($clients_input as $client_input)
            {
                $bareosClients = DB::connection(Catalogs::getCatalogName($director))->table('Client')->where('ClientId', '=', $client_input)->get();

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
            $contactsFull = [];
            foreach($contacts as $contact)
            {
                $contactRecord = Contacts::find($contact);
                $contactArray = [
                    'id'        =>  $contactRecord->id,
                    'name'      =>  $contactRecord->name,
                    'email'     =>  $contactRecord->email,
                    'mobile'    =>  $contactRecord->mobile
                ];

                array_push($contactsFull, $contactArray);
            }
            $contacts = json_encode($contactsFull);
            if(isset($name))
            {
                $job->name = $name;
            }
            if(isset($director))
            {
                $job->director_id = $director;
            }
            if(isset($schedule))
            {
                $job->schedule_id = $schedule;
            }
            if(isset($clients))
            {
                $job->clients = $clients;
            }
            if(isset($template))
            {
                $job->template_id = $template;
            }
            if(isset($contacts))
            {
                $job->contacts = $contacts;
            }

            try {
                $job->save();

                return redirect($redirectUrl)->with('success', 'Job saved successfully');
            }catch(Exception $e)
            {
                return redirect()->back()->with('error', 'Unable to save job');
            }

        }
        else
        {
            return redirect()->back()->with('error', 'Please input a name');
        }
    }

    /**
     * Delete Job
     *
     * @param $director
     * @param $id
     * @return mixed
     */
    public function delete($director, $id)
    {
        $redirectUrl = '/jobs/'.$director;
        $job = Jobs::find($id);

        try {
            $job->delete();

            return redirect($redirectUrl)->with('success', 'Job deleted successfully');
        }catch(Exception $e)
        {
            return redirect($redirectUrl)->with('error', 'Unable to delete job');
        }
    }
}
