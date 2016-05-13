<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Edit Email Settings
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Edit Email Settings / Bareos Reporter</title>
@endsection

@section('content')
    <?php
        if(empty($setting->email_from_address)){
            $email_from_address = old('email_from_address');
        }
        else
        {
            $email_from_address = $setting->email_from_address;
        }
        if(empty($setting->email_from_name)){
            $email_from_name = old('email_from_name');
        }
        else
        {
            $email_from_name = $setting->email_from_name;
        }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Email Settings</h3>
                </div>

                <div class="panel-body">
                    <div class="col-xs-6 col-md-4 col-lg-4">
                        <form class="form-edit-user" role="form" method="POST" action="/settings/email/update">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('email_from_address') ? ' has-error' : '' }}">
                                <label for="email_from_address">Email From Address:</label>
                                <input type="text" class="form-control" name="email_from_address" value="{{ $email_from_address }}" />
                                @if ($errors->has('email_from_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_from_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email_from_name') ? ' has-error' : '' }}">
                                <label for="email_from_name">Email From Name:</label>
                                <input type="text" class="form-control" name="email_from_name" value="{{ $email_from_name }}" />
                                @if ($errors->has('email_from_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_from_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
