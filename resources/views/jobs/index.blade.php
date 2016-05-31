<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * View Director Jobs
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    {{ $director->director_name }} Jobs / Bareos Reporter
@endsection

@section('content-header')
    <h1><span style="text-transform: uppercase">{{ $director->director_name }}</span> Jobs</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="jobs-wrap">
                        <table id="jobs-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Director</th>
                                    <th>Schedule</th>
                                    <th>Clients</th>
                                    <th>Template</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                    <tr>
                                        <td>{{ $job->id }}</td>
                                        <td>{{ $job->name }}</td>
                                        <td>
                                            @if(\App\Jobs::getJobStatus($job->id) === true)
                                                <span class="label label-success">Enabled</span>
                                            @else
                                                <span class="label label-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>{{ \App\Directors::getDirectorName($job->director_id) }}</td>
                                        <td>{{ \App\Schedules::getScheduleName($job->schedule_id) }}</td>
                                        <td>{{ \App\Helper::returnReadableClients($job->clients) }}</td>
                                        <td>{{ \App\Templates::getTemplateName($job->template_id) }}</td>
                                        <td><a href="/jobs/{{ $director->id }}/edit/{{ $job->id }}">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="add-button">
                            <a href="/jobs/{{ $director->id }}/add"><button class="btn btn-flat btn-primary" name="action" value="add"><strong>Add Job</strong></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $('#jobs-table').DataTable( {
                "iDisplayLength": 25
            });
        });
    })(jQuery);
</script>
@endsection
