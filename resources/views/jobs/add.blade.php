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
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <?php $statusOld = old('status'); ?>
                                <label for="status">Status:</label>
                                <select id="status-select" class="selectpicker form-control" name="status">
                                    @if($statusOld == 1)
                                        <option value="1" selected="selected">Enabled</option>
                                        <option value="2">Disabled</option>
                                    @elseif($statusOld == 0)
                                        <option value="0" selected="selected">Disabled</option>
                                        <option value="1">Enabled</option>
                                    @else
                                        <option value="1" selected="selected">Enabled</option>
                                        <option value="0">Disabled</option>
                                    @endif
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('schedule') ? ' has-error' : '' }}">
                                <?php $scheduleOld = old('schedule'); ?>
                                <label for="schedule">Schedule:</label>
                                <select id="schedule-select" class="selectpicker form-control" name="schedule">
                                    @if(!empty($schedules))
                                        @foreach($schedules as $schedule)
                                            @if($schedule->id == $scheduleOld)
                                                <option value="{{ $schedule->id }}" selected>{{ $schedule->name }}</option>
                                            @else
                                                <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                                @if ($errors->has('schedule'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('schedule') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('report-type') ? ' has-error' : '' }}">
                                <?php $reportTypeOld = old('report-type'); ?>
                                <label for="report-type">Report Type:</label>
                                <select id="report-type-select" class="selectpicker form-control" name="report-type">
                                    @if($reportTypeOld == 1)
                                        <option value="1" selected="selected">All Selected Clients (One Report)</option>
                                        <option value="2">Separate report for each selected Client</option>
                                    @elseif($reportTypeOld == 2)
                                        <option value="1">All Selected Clients (One Report)</option>
                                        <option value="2" selected="selected">Separate report for each selected Client</option>
                                    @else
                                        <option value="1" selected="selected">All Selected Clients (One Report)</option>
                                        <option value="2">Separate report for each selected Client</option>
                                    @endif
                                </select>
                                @if ($errors->has('report-type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('report-type') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('clients') ? ' has-error' : '' }}">
                                <?php $clientsOld = old('clients'); ?>
                                <label for="clients[]">Clients:</label>
                                <select id="clients-select" class="selectpicker form-control" name="clients[]" multiple>
                                    @if(is_array($clientsOld))
                                        @if(!empty($clients))
                                            @foreach($clients as $client)
                                                @if(in_array($client->ClientId, $clientsOld))
                                                    <option value="{{ $client->ClientId }}" selected="selected">{{ $client->Name }}</option>
                                                @else
                                                    <option value="{{ $client->ClientId }}">{{ $client->Name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Options Available</option>
                                        @endif
                                    @else
                                        @if(!empty($clients))
                                            @foreach($clients as $client)
                                                <option value="{{ $client->ClientId }}">{{ $client->Name }}</option>
                                            @endforeach
                                        @else
                                            <option value="-1">No Options Available</option>
                                        @endif
                                    @endif
                                </select>
                                @if ($errors->has('clients'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clients') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('template') ? ' has-error' : '' }}">
                                <?php $templateOld = old('template'); ?>
                                <label for="template">Template:</label>
                                <select id="template-select" class="selectpicker form-control" name="template">
                                    @if(!empty($templates))
                                        @foreach($templates as $template)
                                            @if($template->id == $templateOld)
                                                <option value="{{ $template->id }}" selected="selected">{{ $template->name }}</option>
                                            @else
                                                <option value="{{ $template->id }}">{{ $template->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                                @if ($errors->has('template'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('template') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('contacts') ? ' has-error' : '' }}">
                                <?php $contactsOld = old('contacts'); ?>
                                <label for="contacts[]">Recipient Contacts:</label>
                                <select id="contacts-select" class="selectpicker form-control" name="contacts[]" data-live-search="true" multiple>
                                    @if(is_array($contactsOld))
                                        @if(!empty($contacts))
                                            @foreach($contacts as $contact)
                                                @if(in_array($contact->id, $contactsOld))
                                                    <option value="{{ $contact->id }}" selected="selected">{{ $contact->name }} ({{ $contact->email }})</option>
                                                @else
                                                    <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->email }})</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Options Available</option>
                                        @endif
                                    @else
                                        @if(!empty($contacts))
                                            @foreach($contacts as $contact)
                                                <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->email }})</option>
                                            @endforeach
                                        @else
                                            <option value="-1">No Options Available</option>
                                        @endif
                                    @endif
                                </select>
                                @if ($errors->has('contacts'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contacts') }}</strong>
                                    </span>
                                @endif
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
