<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * View Directors
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 */
?>
@extends('layouts.app')

@section('head')
    <title>Directors / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Directors</h3>
                </div>

                <div class="panel-body">
                    <div class="add-button">
                        <a href="/directors/add"><button class="btn btn-primary" name="action" value="add">Add Director</button></a>
                    </div>
                    <div class="directors-wrap">
                        <table id="directors-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Director Name</th>
                                    <th>IP Address</th>
                                    <th>Director Port</th>
                                    <th>Catalog Name</th>
                                    <th>Catalog Status</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($directors as $director)
                                    <tr>
                                        <td>{{ $director->director_name }}</td>
                                        <td>{{ $director->ip_address }}</td>
                                        <td>{{ $director->director_port }}</td>
                                        <td>{{ \App\Catalogs::getCatalogName($director->catalog_id) }}</td>
                                        <td>
                                            @if(\App\Catalogs::getCatalogConnectionStatus($director->id) === true)
                                                <span class="label label-success">Success</span>
                                            @else
                                                <span class="label label-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td><a href="/directors/edit/{{ $director->id }}">Edit</a></td>
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
            $('#directors-table').DataTable( {
                "iDisplayLength": 25
            });
        });
    })(jQuery);
</script>
@endsection
