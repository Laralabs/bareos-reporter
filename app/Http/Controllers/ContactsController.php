<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Contacts Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
 */

namespace App\Http\Controllers;

use App\Contacts;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class ContactsController extends Controller
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
     * Show Contacts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contacts::all();

        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Add Contact View
     *
     * @return mixed
     */
    public function add()
    {
        return view('contacts.add');
    }

    /**
     * Create Contact
     *
     * @return mixed
     */
    public function create()
    {
        $name = Input::get('contact_name');
        $email = Input::get('contact_email');
        $mobile = Input::get('contact_mobile');

        if(!empty($name) && !empty($email))
        {
            $contact = Contacts::create(array(
                'name'      =>  $name,
                'email'     =>  $email,
                'mobile'    =>  $mobile
            ));

            $contact->save();

            return redirect('contacts')->with('success', 'Contact created successfully');
        }
        else
        {
            return redirect('contacts')->with('error', 'Make sure name and email are valid');
        }
    }

    /**
     * Edit Contact View
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $contact = Contacts::find($id);

        return view('contacts.edit', ['contact' => $contact]);
    }

    public function save($id)
    {
        $contact = Contacts::find($id);

        $name = Input::get('contact_name');
        $email = Input::get('contact_email');
        $mobile = Input::get('contact_mobile');

        try {
            if(isset($name))
            {
                $contact->name = $name;
            }
            if(isset($email) && $email != $contact->email)
            {
                $contact->email = $email;
            }
            if(isset($mobile))
            {
                $contact->mobile = $mobile;
            }

            $contact->save();

            return redirect('contacts')->with('success', 'Contact saved successfully');

        }catch(Exception $e)
        {
            return redirect('contacts')->with('error', 'Failed to save contact');
        }
    }
}
