<?php

namespace App\Http\Controllers;

use App\Catalogs;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

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
     * Change the active director catalog
     *
     * @return \Illuminate\Http\Response
     */
    public function changeDirector()
    {
        $director_id = Input::get('director-select');

        $catalog = Catalogs::getDirectorCatalog($director_id);

        return redirect('dashboard')->with('success', 'Director changed successfully');
    }
}
