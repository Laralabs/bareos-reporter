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
@include('layouts.partials.htmlhead')
<body class="sidebar-mini skin-black">
    <div class="wrapper">
        <!-- Main Header -->
            @include('layouts.partials.header')
        <!-- Main Header End -->

        <!-- Sidebar Navigation -->
            @include('layouts.partials.sidebar')
        <!-- Sidebar Navigation End -->

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                @yield('content-header')
            </section>
            <!-- Content Header End -->

            <!-- Alert Message Display -->
                @include('layouts.partials.alerts')
            <!-- Alert Message Display End -->

            <!-- Main Content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- Main Content End -->
        </div>
        <?php
            require base_path().'/version.php';
        ?>
        <!-- Content Wrapper End -->
        <!-- Footer JS Scripts -->
            @include('layouts.partials.scripts')
        <!-- Footer JS Scripts End -->
        <!-- Main Footer -->
            @include('layouts.partials.footer')
        <!-- Main Footer End -->
    </div>
</body>
</html>
