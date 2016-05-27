<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * View Director Clients
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    {{ $director->director_name }} Clients / Bareos Reporter
@endsection

@section('content-header')
    <h1>{{ $director->director_name }} Clients</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="clients-wrap">
                        <table id="clients-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Information</th>
                                    <th>Auto Prune</th>
                                    <th>File Retention</th>
                                    <th>Job Retention</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->ClientId }}</td>
                                        <td>{{ $client->Name }}</td>
                                        <td>{{ $client->Uname }}</td>
                                        <td>{{ $client->AutoPrune }}</td>
                                        <td>{{ \App\Helper::secondsToTime($client->FileRetention) }}</td>
                                        <td>{{ \App\Helper::secondsToTime($client->JobRetention) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $('#clients-table').DataTable( {
                "iDisplayLength": 25
            });
        });
    })(jQuery);
</script>
@endsection
