<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * User Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class UsersController extends Controller
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
     * View Users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('settings.users.index', ['users' => $users]);
    }

    /**
     * Add User View
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('settings.users.add');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'name'     => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Create User
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $userData = array(
            'username'      =>  Input::get('username'),
            'name'          =>  Input::get('name'),
            'email'         =>  Input::get('email'),
            'password'      =>  Input::get('password')
        );

        $this->validate($request, [
            'username' => 'required|max:255',
            'name'     => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $user = $this->register($userData);
            $user->save();
            return redirect('/settings/users')->with('success', 'User created successfully!');
        }catch(Exception $e) {
            return redirect()->back()->with('error', 'Unable to create user');
        }
    }

    /**
     * User Edit View
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('settings.users.edit', ['user' => $user]);
    }

    /**
     * Save User
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, $id)
    {
        $user = User::find($id);

        $userData = array(
            'username'      =>  Input::get('username'),
            'name'          =>  Input::get('name'),
            'email'         =>  Input::get('email'),
            'password'      =>  Input::get('password')
        );

        $email = Input::get('email');
        $password = Input::get('password');

        if(empty($password))
        {
            $this->validate($request, [
                'username' => 'required|max:255',
                'name'     => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,id',
            ]);
        }
        else
        {
            $this->validate($request, [
                'username' => 'required|max:255',
                'name'     => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,id',
                'password' => 'required|min:6|confirmed',
            ]);
        }

        if(!empty($userData['username'])) {
            $user->username = $userData['username'];
        }
        if(!empty($userData['name'])) {
            $user->name = $userData['name'];
        }
        if(!empty($userData['email'])) {
            $user->email = $userData['email'];
        }
        if(array_key_exists('password', $userData) === true) {
            if(!empty($userData['password']))
            {
                $user->password = bcrypt($userData['password']);
            }
        }

        try {
            $user->save();
            return redirect('/settings/users')->with('success', 'User saved successfully!');
        }catch(Exception $e) {
            return redirect()->back()->with('error', 'Unable to save user');
        }
    }

    /**
     * Delete User
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $user = User::find($id);

        try {
            if($user != null)
            {
                $user->delete();

                return redirect('settings/users')->with('success', 'User deleted successfully');
            }
            else
            {
                return redirect('settings/users')->with('error', 'Unable to load user');
            }
        }catch(Exception $e)
        {
            return redirect('settings/users')->with('error', 'Unable to delete user');
        }
    }
}
