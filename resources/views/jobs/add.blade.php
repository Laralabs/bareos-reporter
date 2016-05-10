<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Add Director Job
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>{{ $director->director_name }} Add Job / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Add Job</h3>
                </div>

                <div class="panel-body">
                    <form class="form-add-job" method="POST" action="/jobs/{{ $director->id }}/create">
                        {!! csrf_field() !!}
                        <div class="col-xs-6 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="schedule">Schedule:</label>
                                <select id="schedule-select" class="selectpicker form-control" name="schedule">
                                    @if(!empty($schedules))
                                        @foreach($schedules as $schedule)
                                            <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="clients[]">Clients:</label>
                                <select id="clients-select" class="selectpicker form-control" name="clients[]" multiple>
                                    <option value="-1" selected>None</option>
                                    @if(!empty($clients))
                                        @foreach($clients as $client)
                                            <option value="{{ $client->ClientId }}">{{ $client->Name }}</option>
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="template">Template:</label>
                                <select id="template-select" class="selectpicker form-control" name="template">
                                    @if(!empty($templates))
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contacts[]">Recipient Contacts:</label>
                                <select id="contacts-select" class="selectpicker form-control" name="contacts[]" data-live-search="true" multiple>
                                    <option value="-1" selected>None</option>
                                    @if(!empty($contacts))
                                        @foreach($contacts as $contact)
                                            <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->email }})</option>
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
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
