<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Directors Controller
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
 */

namespace App\Http\Middleware;

use App\Catalogs;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DirectorCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $active_director = Session::get('active_director');
        
        if(isset($active_director) && $active_director != -1)
        {
            $status = Catalogs::getCatalogConnectionStatus($active_director);

            if($status === true)
            {
                return $next($request);
            }
            else
            {
                return Redirect::back()->with('error', 'Director catalog unreachable');
            }
        }
        else
        {
            return Redirect::back()->with('error', 'Please select a valid Director');
        }
    }
}
