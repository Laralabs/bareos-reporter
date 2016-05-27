<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Main Header
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

$directors = \App\Directors::all();
$active_director = \Illuminate\Support\Facades\Session::get('active_director');
?>
<header class="main-header">
    <!-- Logo -->
    <a class="logo" href="/">
        <!-- Mini Logo -->
                <span class="logo-mini">
                    <img src="/images/bareos-logo-small.png" alt="Bareos" />
                </span>
        <!-- Regular Logo -->
                <span class="logo-lg">
                    <img src="/images/bareos-logo-small.png" alt="Bareos" />
                    <span class="app-name">Reporter</span>
                </span>
    </a>
    <!-- Header Navigation Bar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar Toggle Button -->
        <a class="sidebar-toggle" href="#" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right User Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="active-director">
                    <div class="director-select-wrapper">
                        <form id="director-select-form" method="POST" action="/change/director">
                            {!! csrf_field() !!}
                            <div class="director-select-label-wrap">
                                <label class="control-label">DIRECTOR:</label>
                            </div>
                            <div class="director-select-wrap">
                                <select id="director-select" class="selectpicker form-control inline-select director-select" name="director-select">
                                    @if(!empty($directors))
                                        <option value="-1">Please select..</option>
                                        @foreach($directors as $director)
                                            @if(!empty($active_director))
                                                @if($active_director == $director->id)
                                                    <option value="{{ $director->id }}" selected="selected">{{ $director->director_name }}</option>
                                                @else
                                                    <option value="{{ $director->id }}">{{ $director->director_name }}</option>
                                                @endif
                                            @else
                                                <option value="{{ $director->id }}">{{ $director->director_name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1" disabled>No Directors</option>
                                    @endif
                                </select>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        <i class="fa fa-angle-down pull-right" ></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('/settings/users/edit/'.\Illuminate\Support\Facades\Auth::user()->id) }}">
                                <i class="fa fa-cog"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="fa fa-sign-out"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
