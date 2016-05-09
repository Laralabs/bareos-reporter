<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Add Template
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Add Template / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Add Template</h3>
                </div>

                <div class="panel-body">
                    <form class="form-add-template" method="POST" action="/templates/create">
                        {!! csrf_field() !!}
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select id="frequency-select" class="selectpicker form-control" name="status">
                                    <option value="1" selected="selected">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="code">Template Code:</label>
                                <textarea class="form-control" name="code" style="resize: none;" rows="15"></textarea>
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
