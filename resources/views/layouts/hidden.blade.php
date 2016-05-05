<!DOCTYPE html>
<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Hidden Application Layout
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
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

    <!-- JavaScripts -->
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>

    <style>
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

    <div class="container main-logo-wrap">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <a href="http://www.bareos.org/" style="text-decoration: none;"><img src="/images/bareos-full-logo.png" alt="Bareos Open Source Data Protection" /></a>
            </div>
        </div>
        <div class="heading text-center">
            <h2>Reporter</h2>
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
    </div>

    @yield('content')
</body>
</html>
