<!DOCTYPE html>
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

    <style>
        .fa-btn {
            margin-right: 6px;
        }
    </style>
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
                    <li><a href="{{ url('/') }}"><i class="fa fa-server" style="margin-right: 5px;"></i>Directors<i class="fa fa-server small-nav"></i></a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-desktop" style="margin-right: 5px;"></i>Clients<i class="fa fa-desktop small-nav"></i></a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-file" style="margin-right: 5px;"></i>Templates<i class="fa fa-file small-nav"></i></a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-users" style="margin-right: 5px;"></i>Contacts<i class="fa fa-users small-nav"></i></a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-clock-o" style="margin-right: 5px;"></i>Schedules<i class="fa fa-clock-o small-nav"></i></a></li>
                    <li><a href="{{ url('/') }}"><i class="fa fa-cog" style="margin-right: 5px;"></i>Settings<i class="fa fa-cog small-nav"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="navback">

        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
</body>
</html>
