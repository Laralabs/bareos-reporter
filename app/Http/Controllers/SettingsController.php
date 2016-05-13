<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Settings Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class SettingsController extends Controller
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
     * Email Settings View
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function emailIndex()
    {
        $setting = Settings::getSettings();

        return view('settings.email.index', ['setting' => $setting]);
    }

    /**
     * Update Email Settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emailUpdate(Request $request)
    {
        $this->validate($request, [
           'email_from_address'     =>  'required|max:255',
           'email_from_name'     =>  'required|max:255',
        ]);

        $setting = Settings::all()->first();

        if($setting == null)
        {
            try {
                $settingEntry = Settings::create([
                    'email_from_address'        =>  Input::get('email_from_address'),
                    'email_from_name'           =>  Input::get('email_from_name')
                ]);

                $settingEntry->save();

                return redirect('settings/email')->with('success', 'Email settings updated successfully');
            }catch (Exception $e)
            {
                return redirect('settings/email')->with('error', 'Unable to update email settings');
            }
        }
        else
        {
            $email_address = Input::get('email_from_address');
            $email_name = Input::get('email_from_name');

            if(isset($email_address))
            {
                $setting->email_from_address = $email_address;
            }
            if(isset($email_name))
            {
                $setting->email_from_name = $email_name;
            }

            try {
                $setting->save();

                return redirect('settings/email')->with('success', 'Email settings updated successfully');
            }catch (Exception $e)
            {
                return redirect('settings/email')->with('error', 'Unable to update email settings');
            }
        }
    }
}
