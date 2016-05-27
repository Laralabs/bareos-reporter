<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Edit Schedule
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    Edit Schedule / Bareos Reporter
@endsection

@section('content-header')
    <h1>Edit Schedule</h1>
@endsection

<?php
        $add_freqs = unserialize($schedule->add_freq);
?>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $schedule->name }}</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <form class="form-edit-schedule" method="POST" action="/schedules/save/{{ $schedule->id }}">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $schedule->name }}" />
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="frequency{{ $errors->has('frequency') ? ' has-error' : '' }}">Frequency:</label>
                                <?php $freqOld = old('frequency'); if(empty($freqOld)){ $freqOld = $schedule->freq; }; ?>
                                <select id="frequency-select" class="selectpicker form-control" name="frequency">
                                    @if(!empty($frequencies))
                                        @foreach($frequencies as $frequency)
                                            @if($frequency->id == $freqOld)
                                                <option value="{{ $frequency->id }}" selected="selected">{{ $frequency->display_name }}</option>
                                            @else
                                                <option value="{{ $frequency->id }}">{{ $frequency->display_name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                                @if ($errors->has('frequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('frequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('add_frequency') ? ' has-error' : '' }}">
                                <label for="add_frequency[]">Additional Frequency:</label>
                                <select id="add-frequency-select" class="selectpicker form-control" name="add_frequency[]" multiple>
                                    @if(!empty($add_frequencies))
                                        @foreach($add_frequencies as $add_frequency)
                                            @if($add_freqs !== false)
                                                @if(in_array($add_frequency->id, $add_freqs))
                                                    <option value="{{ $add_frequency->id }}" selected="selected">{{ $add_frequency->display_name }}</option>
                                                @endif
                                            @else
                                                <option value="{{ $add_frequency->id }}">{{ $add_frequency->display_name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                                @if ($errors->has('add_frequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add_frequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="text" class="form-control" name="time" placeholder="00:00" value="{{ $schedule->time }}" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-flat btn-primary"><strong>Save</strong></button>
                            </div>
                        </form>
                            <div class="form-group" style="margin-top: 15px;">
                                <button class="btn btn-flat btn-danger" data-record-id="{{ $schedule->id }}" data-record-title="{{ $schedule->name }}" data-toggle="modal" data-target="#confirm-schedule-delete"><strong>Delete</strong></button>
                            </div>
                            <div class="modal fade" id="confirm-schedule-delete" tabindex="-1" role="dialog" aria-labelledby="scheduleDelete" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>You are about to delete <b>{{ $schedule->name }}</b>, this procedure is irreversible.</p>
                                            <p>Do you want to proceed?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><strong>Cancel</strong></button>
                                            <button type="button" class="btn btn-flat btn-danger btn-ok"><strong>Delete</strong></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <script>
                            (function($){
                                $(document).ready(function(){
                                    $('#confirm-schedule-delete').on('click', '.btn-ok', function(e) {
                                        var $modalDiv = $(e.delegateTarget);
                                        var id = $(this).data('recordId');
                                        $(location).attr('href', '/schedules/delete/' + id);
                                    });
                                    $('#confirm-schedule-delete').on('show.bs.modal', function(e) {
                                        var data = $(e.relatedTarget).data();
                                        $('.title', this).text(data.recordTitle);
                                        $('.btn-ok', this).data('recordId', data.recordId);
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
