<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Edit Director Job
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    {{ $director->director_name }} Edit Job / Bareos Reporter
@endsection

@section('content-header')
    <h1><span style="text-transform: uppercase">{{ $director->director_name }}</span> Edit Job</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                     <h3 class="box-title">{{ $job->name }}</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <form class="form-edit-job" method="POST" action="/jobs/{{ $director->id }}/save/{{ $job->id }}">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $job->name }}"/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status">Status:</label>
                                <select id="status-select" class="selectpicker form-control" name="status">
                                    @if($job->status == 1)
                                        <option value="1" selected="selected">Enabled</option>
                                        <option value="2">Disabled</option>
                                    @elseif($job->status == 0)
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
                                <label for="schedule">Schedule:</label>
                                <select id="schedule-select" class="selectpicker form-control" name="schedule">
                                    @if(!empty($schedules))
                                        @foreach($schedules as $schedule)
                                            @if($schedule->id == $job->schedule_id)
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
                                <label for="report-type">Report Type:</label>
                                <select id="report-type-select" class="selectpicker form-control" name="report-type">
                                    @if($job->report_type == 1)
                                        <option value="1" selected="selected">All Selected Clients (One Report)</option>
                                        <option value="2">Separate report for each selected Client</option>
                                    @elseif($job->report_type == 2)
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
                                <label for="clients[]">Clients:</label>
                                <select id="clients-select" class="selectpicker form-control" name="clients[]" multiple>
                                    @if(!empty($clients))
                                        @foreach($clients as $client)
                                            <option value="{{ $client->ClientId }}">{{ $client->Name }}</option>
                                        @endforeach
                                    @endif
                                    @if(empty($clients) && empty($jobClients))
                                        <option value="-1">No Options Available</option>
                                    @endif
                                    @if(!empty($jobClients))
                                        @foreach($jobClients as $jobClient)
                                            <option value="{{ $jobClient->id }}" selected>{{ $jobClient->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('clients'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clients') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('template') ? ' has-error' : '' }}">
                                <label for="template">Template:</label>
                                <select id="template-select" class="selectpicker form-control" name="template">
                                    @if(!empty($templates))
                                        @foreach($templates as $template)
                                            @if($job->template_id == $template->id)
                                                <option value="{{ $template->id }}" selected>{{ $template->name }}</option>
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
                                <label for="contacts[]">Recipient Contacts:</label>
                                <select id="contacts-select" class="selectpicker form-control" name="contacts[]" data-live-search="true" multiple>
                                    @if(!empty($contacts))
                                        @foreach($contacts as $contact)
                                            @if(!empty($selectedContacts))
                                                @if(in_array($contact->id, $selectedContacts))
                                                    <option value="{{ $contact->id }}" selected="selected">{{ $contact->name }} ({{ $contact->email }})</option>
                                                @else
                                                    <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->email }})</option>
                                                @endif
                                            @else
                                                <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->email }})</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                                @if ($errors->has('contacts'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contacts') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn bnt-flat btn-primary"><strong>Save</strong></button>
                            </div>
                        </form>
                        <div class="form-group" style="margin-top: 15px;">
                            <button class="btn btn-flat btn-danger" data-record-id="{{ $job->id }}" data-director-id="{{ $job->director_id }}" data-record-title="{{ $job->name }}" data-toggle="modal" data-target="#confirm-job-delete"><strong>Delete</strong></button>
                        </div>
                        <div class="modal fade" id="confirm-job-delete" tabindex="-1" role="dialog" aria-labelledby="jobDelete" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to delete <b>{{ $job->name }}</b>, this procedure is irreversible.</p>
                                        <p>Do you want to proceed?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><strong>Cancel</strong></button>
                                        <button type="button" class="btn btn-flat btn-danger btn-ok"><strong>Delete</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            (function($){
                                $(document).ready(function(){
                                    $('#confirm-job-delete').on('click', '.btn-ok', function(e) {
                                        var $modalDiv = $(e.delegateTarget);
                                        var id = $(this).data('recordId');
                                        var director = $(this).data('directorId');
                                        $(location).attr('href', '/jobs/' + director + '/delete/' + id);
                                    });
                                    $('#confirm-job-delete').on('show.bs.modal', function(e) {
                                        var data = $(e.relatedTarget).data();
                                        $('.title', this).text(data.recordTitle);
                                        $('.btn-ok', this).data('recordId', data.recordId);
                                        $('.btn-ok', this).data('directorId', data.directorId);
                                    });
                                });
                            })(jQuery);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
