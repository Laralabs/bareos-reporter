<!DOCTYPE html>
<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Authentication Layout
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
<html lang="en">
@include('layouts.partials.htmlhead')
<body id="skin-black no-session hold-transition">
    @yield('content')
    <?php
        require base_path().'/version.php';
    ?>
    <!-- Footer JS Scripts -->
    @include('layouts.partials.scripts')
    <!-- Footer JS Scripts End -->
    <!-- Main Footer -->
    @include('layouts.partials.authfooter')
    <!-- Main Footer End -->
</body>
</html>
