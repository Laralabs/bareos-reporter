<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Templates Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Http\Controllers;

use App\Templates;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class TemplatesController extends Controller
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
     * Show templates
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Templates::all();

        return view('templates.index', ['templates' => $templates]);
    }

    /**
     * Add Template View
     *
     * @return mixed
     */
    public function add()
    {
        return view('templates.add');
    }

    /**
     * Create Template
     *
     * @return mixed
     */
    public function create()
    {
        $name = Input::get('name');
        $status = Input::get('status');
        $code = Input::get('code');

        if(!empty($name))
        {
            try {
                $template = Templates::create(array(
                    'name'          =>  $name,
                    'status'        =>  $status,
                    'template_code' =>  $code
                ));

                return redirect('templates')->with('success', 'Template created successfully');
            }catch(Exception $e)
            {
                return redirect()->back()->with('error', 'Unable to create template');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Please provide a name');
        }
    }

    /**
     * Edit Template View
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $template = Templates::find($id);

        return view('templates.edit', ['template' => $template]);
    }

    /**
     * Save Template
     *
     * @param $id
     * @return mixed
     */
    public function save($id)
    {
        $template = Templates::find($id);

        $name = Input::get('name');
        $status = Input::get('status');
        $code = Input::get('code');

        if($template != null)
        {
            if(!empty($name))
            {
                try {
                    if(isset($name))
                    {
                        $template->name = $name;
                    }
                    if(isset($status))
                    {
                        $template->status = $status;
                    }
                    if(isset($code))
                    {
                        $template->template_code = $code;
                    }

                    $template->save();

                    return redirect('templates')->with('success', 'Template saved successfully');
                }catch(Exception $e)
                {
                    return redirect()->back()->with('error', 'Unable to save template');
                }
            }
            else
            {
                return redirect()->back()->with('error', 'Please provide a name');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Unable to load template');
        }
    }

    /**
     * Delete template
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $template = Templates::find($id);

        try {
            if($template != null)
            {
                $template->delete();

                return redirect('templates')->with('success', 'Template deleted successfully');
            }
            else
            {
                return redirect('templates')->with('error', 'Unable to load template');
            }
        }catch(Exception $e)
        {
            return redirect('templates')->with('error', 'Unable to delete template');
        }
    }
}
