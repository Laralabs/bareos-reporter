<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Run Job Artisan Command
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Console\Commands;

use App\Catalogs;
use App\Contacts;
use App\Directors;
use App\Jobs;
use App\Schedules;
use App\Templates;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RunJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporter:run {job}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobId = $this->argument('job');
        Log::info('Reporter:run artisan command');
        if(!empty($jobId))
        {
            $job = Jobs::find($jobId);
            $schedule = Schedules::find($job->schedule_id);
            $director = Directors::find($job->director_id);
            $template = Templates::find($job->template_id);
            $catalog = Catalogs::getDirectorCatalog($job->director_id);
            $catalogName = $catalog->name;

            $clients = json_decode($job->clients);
            $contacts = json_decode($job->contacts);

            $fileName = 'email'.$jobId.'.blade.php';
            $code = $template->template_code;

            $blade = fopen(resource_path('/views/email/'.$fileName), 'w');
            if($blade !== false)
            {
                fwrite($blade, $code);
                $tempBlade = fclose($blade);

                if($tempBlade === true)
                {
                    // Let's build up the report data.
                    $clientData = array();
                    foreach($clients as $client)
                    {
                        $ukDate = date('Y-m-d');
                        $usDate = date('Y-d-m');
                        $datePattern = '';
                        $ukCollection = DB::connection($catalogName)->table('Job')->where('StartTime', 'LIKE', '%'.$ukDate.'%')->get();
                        if(count($ukCollection) > 0)
                        {
                            $datePattern = $ukDate;
                        }
                        else
                        {
                            $usCollection = DB::connection($catalogName)->table('Job')->where('StartTime', 'LIKE', '%'.$usDate.'%')->get();

                            if(count($usCollection) == 0)
                            {
                                Log::error('No US or UK Dates Found in Job Data');
                                exit();
                            }
                            else
                            {
                                $datePattern = $usDate;
                            }
                        }

                        //GATHER SUCCESS (T)
                        $successCollection = DB::connection($catalogName)->table('Job')->where('ClientId', '=', $client->id)->where('JobStatus', '=', 'T')->where('Type', '=', 'B')->where('StartTime', 'LIKE', '%'.$ukDate.'%')->get();
                        $successCount = count($successCollection);

                        //GATHER ERROR (f + E)
                        $errorCollection = DB::connection($catalogName)->table('Job')->where('ClientId', '=', $client->id)->where('JobStatus', '=', 'f')->where('JobStatus', '=', 'E')->where('Type', '=', 'B')->where('StartTime', 'LIKE', '%'.$ukDate.'%')->get();
                        $errorCount = count($errorCollection);

                        //GATHER WARNING (W)
                        $warningCollection = DB::connection($catalogName)->table('Job')->where('ClientId', '=', $client->id)->where('JobStatus', '=', 'W')->where('Type', '=', 'B')->where('StartTime', 'LIKE', '%'.$ukDate.'%')->get();
                        $warningCount = count($warningCollection);

                        $clientArray = array(
                            'id'        =>  $client->id,
                            'name'      =>  $client->name,
                            'success'   =>  $successCount,
                            'error'     =>  $errorCount,
                            'warning'   =>  $warningCount
                        );

                        array_push($clientData, $clientArray);
                    }

                    $data = array(
                        'clients'       =>  $clientData,
                        'director'      =>  $director,
                        'job'           =>  $job
                    );
                    $email = Mail::send('email.email'.$jobId.'', $data, function ($message) use ($data) {
                        $message->from('hello@reporter.com', 'Bareos Reporter');

                        $job = $data['job'];
                        $director = Directors::find($job->director_id);
                        $contacts = json_decode($job->contacts);
                        $message->subject(''.$director->director_name.' Backup Report: '.date('Y-m-d'));

                        foreach($contacts as $contact)
                        {
                            $contactRecord = Contacts::find($contact);
                            $message->to($contactRecord->email, $contactRecord->name);
                        }
                    });
                }
            }
        }
    }
}
