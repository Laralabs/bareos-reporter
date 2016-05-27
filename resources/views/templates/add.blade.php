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

@section('head-title')
    Add Template / Bareos Reporter
@endsection

@section('content-header')
    <h1>Add Template</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form class="form-add-template" method="POST" action="/templates/create">
                        {!! csrf_field() !!}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" />
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <?php $status = old('status'); ?>
                                <label for="status">Status:</label>
                                <select id="frequency-select" class="selectpicker form-control" name="status">
                                    @if($status == 1)
                                        <option value="1" selected="selected">Enabled</option>
                                        <option value="0">Disabled</option>
                                    @elseif($status == 0)
                                        <option value="1">Enabled</option>
                                        <option value="0" selected="selected">Disabled</option>
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
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code">Template Code:</label>
                                <textarea class="form-control" name="code" style="resize: none;" rows="15"></textarea>
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-flat btn-primary"><strong>Save</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
