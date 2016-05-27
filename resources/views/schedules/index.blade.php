<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * View Schedules
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    Schedules / Bareos Reporter
@endsection

@section('content-header')
    <h1>Schedules</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="schedules-wrap">
                        <table id="schedules-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Frequency</th>
                                    <th>Additional Frequency</th>
                                    <th>Time</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->name }}</td>
                                        <td>{{ \App\SchedulesOptions::getName($schedule->freq) }}</td>
                                        <td>{{ \App\SchedulesOptions::getReadableAddFreq($schedule->add_freq) }}</td>
                                        <td>{{ $schedule->time }}</td>
                                        <td><a href="/schedules/edit/{{ $schedule->id }}">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="add-button">
                            <a href="/schedules/add"><button class="btn btn-flat btn-primary" name="action" value="add"><strong>Add Schedule</strong></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $('#schedules-table').DataTable( {
                "iDisplayLength": 25
            });
        });
    })(jQuery);
</script>
@endsection
