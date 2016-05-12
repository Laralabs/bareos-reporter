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

@section('head')
    <title>{{ $director->director_name }} Edit Job / Bareos Reporter</title>
@endsection

@section('content')
    <?php
            $jobClients = json_decode($job->clients);
            $jobContacts = json_decode($job->contacts);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Edit Job</h3>
                </div>

                <div class="panel-body">
                    <div class="col-xs-6 col-md-4 col-lg-4">
                        <form class="form-add-job" method="POST" action="/jobs/{{ $director->id }}/save/{{ $job->id }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $job->name }}" />
                            </div>
                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
                                <label for="clients[]">Clients:</label>
                                <select id="clients-select" class="selectpicker form-control" name="clients[]" multiple>
                                    @if(!empty($clients))
                                        <option value="-1">None</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->ClientId }}">{{ $client->Name }}</option>
                                        @endforeach
                                    @endif
                                    @if(empty($clients) && empty($jobClients))
                                        <option value="-1">No Options Available</option>
                                    @endif
                                    @if(!empty($jobClients))
                                        <option value="-1">None</option>
                                        @foreach($jobClients as $jobClient)
                                            <option value="{{ $jobClient->id }}" selected>{{ $jobClient->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
                                <label for="contacts[]">Recipient Contacts:</label>
                                <select id="contacts-select" class="selectpicker form-control" name="contacts[]" data-live-search="true" multiple>
                                    @if(!empty($contacts))
                                        <option value="-1">None</option>
                                        @foreach($contacts as $contact)
                                            <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->email }})</option>
                                        @endforeach
                                        @if(!empty($jobContacts))
                                            @foreach($jobContacts as $jobContact)
                                                <option value="{{ $jobContact->id }}" selected="selected">{{ $jobContact->name }} ({{ $jobContact->email }})</option>
                                            @endforeach
                                        @endif
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                            </div>
                        </form>
                        <div class="form-group" style="margin-top: 30px;">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <div class="form-group" style="margin-top: 15px;">
                            <button class="btn btn-danger" data-record-id="{{ $job->id }}" data-director-id="{{ $job->director_id }}" data-record-title="{{ $job->name }}" data-toggle="modal" data-target="#confirm-job-delete">Delete</button>
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
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger btn-ok">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
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
