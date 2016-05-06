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

@section('head')
    <title>Edit Schedule / Bareos Reporter</title>
@endsection
<?php
        $add_freqs = unserialize($schedule->add_freq);
?>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Edit Schedule</h3>
                </div>

                <div class="panel-body">
                    <form class="form-edit-schedule" method="POST" action="/schedules/save/{{ $schedule->id }}">
                        {!! csrf_field() !!}
                        <div class="col-xs-6 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $schedule->name }}"/>
                            </div>
                            <div class="form-group">
                                <label for="frequency">Frequency:</label>
                                <select id="frequency-select" class="selectpicker form-control" name="frequency">
                                    @if(!empty($frequencies))
                                        @foreach($frequencies as $frequency)
                                            @if($frequency->id == $schedule->freq)
                                                <option value="{{ $frequency->id }}" selected="selected">{{ $frequency->display_name }}</option>
                                            @else
                                                <option value="{{ $frequency->id }}">{{ $frequency->display_name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="add_frequency[]">Additional Frequency:</label>
                                <select id="add-frequency-select" class="selectpicker form-control" name="add_frequency[]" multiple>
                                    @if($add_freqs)
                                        <option value="-1">None</option>
                                    @else
                                        <option value="-1" selected>None</option>
                                    @endif
                                    @if(!empty($add_frequencies))
                                        @foreach($add_frequencies as $add_frequency)
                                            @if(in_array($add_frequency->id, $add_freqs))
                                                <option value="{{ $add_frequency->id }}" selected="selected">{{ $add_frequency->display_name }}</option>
                                            @else
                                                <option value="{{ $add_frequency->id }}">{{ $add_frequency->display_name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="-1">No Options Available</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="text" class="form-control" name="time" placeholder="00:00" value="{{ $schedule->time }}" />
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
