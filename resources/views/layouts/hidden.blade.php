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

    <div class="container main-logo-wrap">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <a href="http://www.bareos.org/" style="text-decoration: none;"><img src="/images/bareos-full-logo.png" alt="Bareos Open Source Data Protection" /></a>
            </div>
        </div>
        <div class="heading text-center">
            <h2>Reporter</h2>
        </div>
    </div>

    @yield('content')

    <!-- JavaScripts -->
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
</body>
</html>
