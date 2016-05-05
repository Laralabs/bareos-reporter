<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Edit Contact
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Edit Contact / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Edit Contact</h3>
                </div>

                <div class="panel-body">
                    <form class="form-edit-contact" method="POST" action="/contacts/save/{{ $contact->id }}">
                        {!! csrf_field() !!}
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="contact_name">Name:</label>
                                <input type="text" class="form-control" name="contact_name" value="{{ $contact->name }}" />
                            </div>
                            <div class="form-group">
                                <label for="contact_email">Email Address:</label>
                                <input type="text" class="form-control" name="contact_email" value="{{ $contact->email }}"/>
                            </div>
                            <div class="form-group">
                                <label for="contact_mobile">Mobile Number:</label>
                                <input type="text" class="form-control" name="contact_mobile" value="{{ $contact->mobile }}"/>
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
