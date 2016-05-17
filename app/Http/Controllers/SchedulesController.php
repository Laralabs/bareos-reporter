<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Schedules Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Http\Controllers;

use App\Schedules;
use App\SchedulesOptions;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;

class SchedulesController extends Controller
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
     * Show schedules
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedules::all();

        return view('schedules.index', ['schedules' => $schedules]);
    }

    /**
     * Add schedule
     *
     * @return mixed
     */
    public function add()
    {
        $frequencies = SchedulesOptions::all()->where('type', 'freq');
        $add_frequencies = SchedulesOptions::all()->where('type', 'add_freq');

        return view('schedules.add', ['frequencies' => $frequencies, 'add_frequencies' => $add_frequencies]);
    }

    /**
     * Create schedule
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name'          =>  'required|max:255',
            'frequency'     =>  'required|max:255',
            'add_frequency' =>  'max:255',
        ]);

        $name = Input::get('name');
        $frequency = Input::get('frequency');
        $add_frequency = Input::get('add_frequency');
        if($add_frequency == null)
        {
            $add_frequency = '';
        }
        $time = Input::get('time');

        if($frequency == SchedulesOptions::DAILYAT)
        {
            $this->validate($request, [
                'time'          =>  'required|max:255',
            ]);
        }
        if($add_frequency)
        {
            $add_freq_serial = serialize($add_frequency);
        }
        else
        {
            $add_freq_serial = $add_frequency;
        }

        if($frequency != -1)
        {
            try {
                $scheduleRecord = Schedules::create(array(
                    'name'      =>  $name,
                    'freq'      =>  $frequency,
                    'add_freq'  =>  $add_freq_serial,
                    'time'      =>  $time
                ));

                $scheduleRecord->save();

                return redirect('schedules')->with('success', 'Schedule created successfully');

            }catch(Exception $e)
            {
                return redirect('schedules')->with('error', 'Failed to create schedule');
            }
        }
        else
        {
            return redirect('schedules')->with('error', 'Please select a frequency');
        }
    }

    /**
     * Edit schedule
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $schedule = Schedules::find($id);
        $frequencies = SchedulesOptions::all()->where('type', 'freq');
        $add_frequencies = SchedulesOptions::all()->where('type', 'add_freq');

        return view('schedules.edit', ['schedule' => $schedule, 'frequencies' => $frequencies, 'add_frequencies' => $add_frequencies]);
    }

    /**
     * Save schedule
     *
     * @param $id
     * @return mixed
     */
    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'name'          =>  'required|max:255',
            'frequency'     =>  'required|max:255',
            'add_frequency' =>  'max:255',
        ]);
        $schedule = Schedules::find($id);

        $name = Input::get('name');
        $frequency = Input::get('frequency');
        $add_frequency = Input::get('add_frequency');
        if($add_frequency == null)
        {
            $add_frequency = '';
        }
        $time = Input::get('time');

        if($frequency == SchedulesOptions::DAILYAT)
        {
            $this->validate($request, [
                'time'          =>  'required|max:255',
            ]);
        }
        if($add_frequency)
        {
            $add_freq_serial = serialize($add_frequency);
        }
        else {
            $add_freq_serial = $add_frequency;
        }

        if(!empty($name) && !empty($frequency) && $frequency != -1)
        {
            try {
                $schedule->name = $name;
                $schedule->freq = $frequency;
                $schedule->add_freq = $add_freq_serial;
                $schedule->time = $time;

                $schedule->save();

                return redirect('schedules')->with('success', 'Schedule saved successfully');
            }catch(Exception $e)
            {
                return Redirect::back()->with('error', 'Unable to save schedule');
            }
        }
        else
        {
            return redirect('schedules')->with('error', 'Please make sure name and frequency are valid');
        }
    }

    /**
     * Delete schedule
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $schedule = Schedules::find($id);

        try {
            if($schedule != null)
            {
                $schedule->delete();

                return redirect('schedules')->with('success', 'Schedule deleted successfully');
            }
            else
            {
                return redirect('schedules')->with('error', 'Unable to load schedule');
            }
        }catch(Exception $e)
        {
            return redirect('schedules')->with('error', 'Unable to delete schedule');
        }
    }
}
