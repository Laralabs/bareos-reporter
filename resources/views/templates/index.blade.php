<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * View Templates
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    Templates / Bareos Reporter
@endsection

@section('content-header')
    <h1>Templates</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="templates-wrap">
                        <table id="templates-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>HTML Code</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                    <tr>
                                        <td>{{ $template->id }}</td>
                                        <td>{{ $template->name }}</td>
                                        <td>
                                            @if($template->status == 1)
                                                <span class="label label-success">Enabled</span>
                                            @else
                                                <span class="label label-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>{{ \App\Templates::getShorthandCode($template->id) }}</td>
                                        <td><a href="/templates/edit/{{ $template->id }}">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="add-button">
                            <a href="/templates/add"><button class="btn btn-flat btn-primary" name="action" value="add"><strong>Add Template</strong></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $('#templates-table').DataTable( {
                "iDisplayLength": 25
            });
        });
    })(jQuery);
</script>
@endsection
