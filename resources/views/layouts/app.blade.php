<!DOCTYPE html>
<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Logged in Application Layout
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />

    @yield('head')

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/css/app.css" >
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css" >
    <link rel="stylesheet" type="text/css" href="/css/dataTables.css" >
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-select.css" >

    <!-- JavaScripts -->
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/dataTables.js"></script>

    <style>
        .fa-btn {
            margin-right: 6px;
        }
    </style>

    <?php
        $directors = \App\Directors::all();
        $active_director = \Illuminate\Support\Facades\Session::get('active_director');
    ?>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default sidebar" role="navigation">
        <div class="navtop">
            <div class="navbar-brand-wrap">
                <div class="logo-wrap">
                    <a class="bareos-logo" href="http://www.bareos.org/"><img src="/images/bareos-logo-small.png" alt="Bareos" /></a>
                    <a class="navbar-brand app-name" href="{{ url('/') }}">Reporter</a>
                </div>
                <div class="mobile-nav-toggle">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <br class="clear" />
            </div>
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-tachometer" style="margin-right: 5px;"></i>Dashboard<i class="fa fa-tachometer small-nav"></i></a></li>
                    <li><a href="{{ url('/directors') }}"><i class="fa fa-server" style="margin-right: 5px;"></i>Directors<i class="fa fa-server small-nav"></i></a></li>
                    <li><a href="{{ url('/clients') }}"><i class="fa fa-desktop" style="margin-right: 5px;"></i>Clients<i class="fa fa-desktop small-nav"></i></a></li>
                    @if(!empty($active_director) && $active_director != -1)
                        <li><a href="{{ url('/jobs/'.$active_director) }}"><i class="fa fa-line-chart" style="margin-right: 5px;"></i>Jobs<i class="fa fa-line-chart small-nav"></i></a></li>
                    @endif
                    <li><a href="{{ url('/schedules') }}"><i class="fa fa-clock-o" style="margin-right: 5px;"></i>Schedules<i class="fa fa-clock-o small-nav"></i></a></li>
                    <li><a href="{{ url('/templates') }}"><i class="fa fa-file" style="margin-right: 5px;"></i>Templates<i class="fa fa-file small-nav"></i></a></li>
                    <li><a href="{{ url('/contacts') }}"><i class="fa fa-users" style="margin-right: 5px;"></i>Contacts<i class="fa fa-users small-nav"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" style="margin-right: 5px;"></i>Settings<i class="fa fa-cog small-nav"></i><span class="caret"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="{{ url('/settings/users') }}">Users</a></li>
                            <li><a href="{{ url('/settings/email') }}">Email Settings</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navback">

        </div>
    </nav>

    <div class="container content-container">
        <div class="row director-select-row">
        <div class="col-md-12">
            <form id="director-select-form" method="POST" action="/change/director">
                {!! csrf_field() !!}
                <div class="director-select-label-wrap">
                    <span class="director-select-label">ACTIVE DIRECTOR:</span>
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
        </div>
        <?php
        $error = \Illuminate\Support\Facades\Session::get('error');
        $success = \Illuminate\Support\Facades\Session::get('success');
        $warning = \Illuminate\Support\Facades\Session::get('warning');
        ?>
        @if(isset($error) || isset($success) || isset($warning))
            @if(isset($error))
                <script type="text/javascript">
                    (function($) {
                        $(document).ready(function () {
                            $("div.error").fadeIn(300).delay(1500).fadeOut(400);
                        });
                    })(jQuery);
                </script>
                <div class="row message-container error"  style="display: none; padding-bottom: 0 !important;">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-times"></i></strong> {{ $error }}
                        </div>
                    </div>
                </div>
                <?php \Illuminate\Support\Facades\Session::forget('error'); ?>
            @endif
            @if(isset($success))
                <script type="text/javascript">
                    (function($) {
                        $(document).ready(function () {
                            $("div.success").fadeIn(300).delay(1500).fadeOut(400);
                        });
                    })(jQuery);
                </script>
                <div class="row message-container success" style="display: none; padding-bottom: 0 !important;">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <strong><i class="fa fa-check-circle"></i></strong> {{ $success }}
                        </div>
                    </div>
                </div>
                <?php \Illuminate\Support\Facades\Session::forget('success'); ?>
            @endif
            @if(isset($warning))
                <script type="text/javascript">
                    (function($) {
                        $(document).ready(function () {
                            $("div.warning").fadeIn(300).delay(1500).fadeOut(400);
                        });
                    })(jQuery);
                </script>
                <div class="row message-container warning" style="display: none; padding-bottom: 0 !important;">
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            <strong><i class="fa fa-exclamation-triangle"></i></strong> {{ $warning }}
                        </div>
                    </div>
                </div>
                <?php \Illuminate\Support\Facades\Session::forget('warning'); ?>
            @endif
        @endif
        @yield('content')
    </div>

    <script type="text/javascript" src="/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="/js/director.js"></script>
    <script type="text/javascript" src="/js/deleteModal.js"></script>
</body>
</html>
