<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Add Schedule
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Add Schedule / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Add Schedule</h3>
                </div>

                <div class="panel-body">
                    <form class="form-add-schedule" method="POST" action="/schedules/create">
                        {!! csrf_field() !!}
                        <div class="col-xs-6 col-md-4 col-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('frequency') ? ' has-error' : '' }}">
                                <?php $freqOld = old('frequency'); ?>
                                <label for="frequency">Frequency:</label>
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
                                    <?php
                                        $addFreqOld = old('add_frequency');
                                    ?>
                                    @if(is_array($addFreqOld))
                                            @if(!empty($add_frequencies))
                                                @foreach($add_frequencies as $add_frequency)
                                                        @if(in_array($add_frequency->id, $addFreqOld))
                                                            <option value="{{ $add_frequency->id }}" selected="selected">{{ $add_frequency->display_name }}</option>
                                                        @else
                                                            <option value="{{ $add_frequency->id }}">{{ $add_frequency->display_name }}</option>
                                                        @endif
                                                @endforeach
                                            @else
                                                <option value="-1">No Options Available</option>
                                            @endif
                                    @else
                                            @if(!empty($add_frequencies))
                                                @foreach($add_frequencies as $add_frequency)
                                                    <option value="{{ $add_frequency->id }}">{{ $add_frequency->display_name }}</option>
                                                @endforeach
                                            @else
                                                <option value="-1">No Options Available</option>
                                            @endif
                                    @endif
                                </select>
                                @if ($errors->has('add_frequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add_frequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                <label for="time">Time:</label>
                                <input type="text" class="form-control" name="time" placeholder="00:00" value="{{ old('time') }}" />
                                @if ($errors->has('time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('time') }}</strong>
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
