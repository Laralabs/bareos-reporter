<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Register Jobs Artisan Command
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Console\Commands;

use App\Jobs;
use App\Schedules;
use App\SchedulesOptions;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class RegisterJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporter:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registers all of jobs';

    /**
     * The schedule instance.
     *
     * @var \Illuminate\Console\Scheduling\Schedule
     */
    protected $schedule;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
        parent::__construct();
    }

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule()
    {
        $jobs = Jobs::all();
        $commandName = 'reporter:run';

        /**
         * Define non job schedules
         */
        // Cycles through contacts and validates the MX Records
        $this->schedule->command('reporter:mxvalidate')->hourly();

        foreach($jobs as $job) {
            if ($job->status == Jobs::JOB_ENABLED) {
                $schedule_record = Schedules::find($job->schedule_id);
                $schedule_time = $schedule_record->time;
                $jobId = $job->id;
                $freq = $schedule_record->freq;
                $add_freq = unserialize($schedule_record->add_freq);

                switch ($freq) {
                    case SchedulesOptions::HOURLY:
                        $command = $this->schedule->command($commandName.' '.$jobId)->hourly();
                        if(!empty($add_freq))
                        {
                            foreach($add_freq as $addfreq)
                            {
                                switch($addfreq) {
                                    case SchedulesOptions::WEEKDAYS:
                                        $command = $command->weekdays();
                                        break;
                                    case SchedulesOptions::SATURDAYS:
                                        $command = $command->saturdays();
                                        break;
                                    case SchedulesOptions::SUNDAYS:
                                        $command = $command->sundays();
                                        break;
                                    case SchedulesOptions::MONDAYS:
                                        $command = $command->mondays();
                                        break;
                                    case SchedulesOptions::TUESDAYS:
                                        $command = $command->tuesdays();
                                        break;
                                    case SchedulesOptions::WEDNESDAYS:
                                        $command = $command->wednesdays();
                                        break;
                                    case SchedulesOptions::THURSDAYS:
                                        $command = $command->thursdays();
                                        break;
                                    case SchedulesOptions::FRIDAYS:
                                        $command = $command->fridays();
                                        break;
                                }
                            }
                        }
                        break;
                    case SchedulesOptions::DAILY:
                        $command = $this->schedule->command($commandName.' '.$jobId)->daily();
                        break;
                    case SchedulesOptions::DAILYAT:
                        if(!empty($schedule_time))
                        {
                            $command = $this->schedule->command($commandName.' '.$jobId)->dailyAt($schedule_time);
                        }
                        break;
                    case SchedulesOptions::WEEKLY:
                        $command = $this->schedule->command($commandName.' '.$jobId)->weekly();
                        if(!empty($add_freq))
                        {
                            foreach($add_freq as $addfreq)
                            {
                                switch($addfreq) {
                                    case SchedulesOptions::WEEKDAYS:
                                        $command = $command->weekdays();
                                        break;
                                    case SchedulesOptions::SATURDAYS:
                                        $command = $command->saturdays();
                                        break;
                                    case SchedulesOptions::SUNDAYS:
                                        $command = $command->sundays();
                                        break;
                                    case SchedulesOptions::MONDAYS:
                                        $command = $command->mondays();
                                        break;
                                    case SchedulesOptions::TUESDAYS:
                                        $command = $command->tuesdays();
                                        break;
                                    case SchedulesOptions::WEDNESDAYS:
                                        $command = $command->wednesdays();
                                        break;
                                    case SchedulesOptions::THURSDAYS:
                                        $command = $command->thursdays();
                                        break;
                                    case SchedulesOptions::FRIDAYS:
                                        $command = $command->fridays();
                                        break;
                                }
                            }
                        }
                        if(!empty($schedule_time))
                        {
                            $command = $command->at($schedule_time);
                        }
                        break;
                    case SchedulesOptions::MONTHLY:
                        $command = $this->schedule->command($commandName.' '.$jobId)->monthly();
                        if(!empty($add_freq))
                        {
                            foreach($add_freq as $addfreq)
                            {
                                switch($addfreq) {
                                    case SchedulesOptions::WEEKDAYS:
                                        $command = $command->weekdays();
                                        break;
                                    case SchedulesOptions::SATURDAYS:
                                        $command = $command->saturdays();
                                        break;
                                    case SchedulesOptions::SUNDAYS:
                                        $command = $command->sundays();
                                        break;
                                    case SchedulesOptions::MONDAYS:
                                        $command = $command->mondays();
                                        break;
                                    case SchedulesOptions::TUESDAYS:
                                        $command = $command->tuesdays();
                                        break;
                                    case SchedulesOptions::WEDNESDAYS:
                                        $command = $command->wednesdays();
                                        break;
                                    case SchedulesOptions::THURSDAYS:
                                        $command = $command->thursdays();
                                        break;
                                    case SchedulesOptions::FRIDAYS:
                                        $command = $command->fridays();
                                        break;
                                }
                            }
                        }
                        if(!empty($schedule_time))
                        {
                            $command = $command->at($schedule_time);
                        }
                        break;
                    case SchedulesOptions::QUARTERLY:
                        $command = $this->schedule->command($commandName.' '.$jobId)->quarterly();
                        if(!empty($add_freq))
                        {
                            foreach($add_freq as $addfreq)
                            {
                                switch($addfreq) {
                                    case SchedulesOptions::WEEKDAYS:
                                        $command = $command->weekdays();
                                        break;
                                    case SchedulesOptions::SATURDAYS:
                                        $command = $command->saturdays();
                                        break;
                                    case SchedulesOptions::SUNDAYS:
                                        $command = $command->sundays();
                                        break;
                                    case SchedulesOptions::MONDAYS:
                                        $command = $command->mondays();
                                        break;
                                    case SchedulesOptions::TUESDAYS:
                                        $command = $command->tuesdays();
                                        break;
                                    case SchedulesOptions::WEDNESDAYS:
                                        $command = $command->wednesdays();
                                        break;
                                    case SchedulesOptions::THURSDAYS:
                                        $command = $command->thursdays();
                                        break;
                                    case SchedulesOptions::FRIDAYS:
                                        $command = $command->fridays();
                                        break;
                                }
                            }
                        }
                        if(!empty($schedule_time))
                        {
                            $command = $command->at($schedule_time);
                        }
                        break;
                    case SchedulesOptions::YEARLY:
                        $command = $this->schedule->command($commandName.' '.$jobId)->yearly();
                        if(!empty($add_freq))
                        {
                            foreach($add_freq as $addfreq)
                            {
                                switch($addfreq) {
                                    case SchedulesOptions::WEEKDAYS:
                                        $command = $command->weekdays();
                                        break;
                                    case SchedulesOptions::SATURDAYS:
                                        $command = $command->saturdays();
                                        break;
                                    case SchedulesOptions::SUNDAYS:
                                        $command = $command->sundays();
                                        break;
                                    case SchedulesOptions::MONDAYS:
                                        $command = $command->mondays();
                                        break;
                                    case SchedulesOptions::TUESDAYS:
                                        $command = $command->tuesdays();
                                        break;
                                    case SchedulesOptions::WEDNESDAYS:
                                        $command = $command->wednesdays();
                                        break;
                                    case SchedulesOptions::THURSDAYS:
                                        $command = $command->thursdays();
                                        break;
                                    case SchedulesOptions::FRIDAYS:
                                        $command = $command->fridays();
                                        break;
                                }
                            }
                        }
                        if(!empty($schedule_time))
                        {
                            $command = $command->at($schedule_time);
                        }
                        break;
                }
            }
        }

        $events = $this->schedule->dueEvents($this->laravel);
        $allEvents = $this->schedule->events();

        $eventsRan = 0;

        foreach ($events as $event) {
            if (! $event->filtersPass($this->laravel)) {
                continue;
            }

            $this->line('<info>Running scheduled command:</info> '.$event->getSummaryForDisplay());

            $event->run($this->laravel);

            ++$eventsRan;
        }

        if (count($events) === 0 || $eventsRan === 0) {
            $this->info('No scheduled commands are ready to run.');
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->schedule($this->schedule);
    }
}
