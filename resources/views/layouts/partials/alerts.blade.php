<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Alert Message Display
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */

$error = \Illuminate\Support\Facades\Session::get('error');
$success = \Illuminate\Support\Facades\Session::get('success');
$warning = \Illuminate\Support\Facades\Session::get('warning');
$info = \Illuminate\Support\Facades\Session::get('info');
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
                    <h4><i class="fa fa-times"></i> {{ $error }}</h4>
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
                    <h4><i class="fa fa-check"></i> {{ $success }}</h4>
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
                    <h4><i class="fa fa-exclamation-triangle"></i> {{ $warning }}</h4>
                </div>
            </div>
        </div>
        <?php \Illuminate\Support\Facades\Session::forget('warning'); ?>
    @endif
    @if(isset($info))
        <script type="text/javascript">
            (function($) {
                $(document).ready(function () {
                    $("div.info").fadeIn(300).delay(1500).fadeOut(400);
                });
            })(jQuery);
        </script>
        <div class="row message-container info" style="display: none; padding-bottom: 0 !important;">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <h4><i class="fa fa-info"></i> {{ $info }}</h4>
                </div>
            </div>
        </div>
        <?php \Illuminate\Support\Facades\Session::forget('info'); ?>
    @endif
@endif