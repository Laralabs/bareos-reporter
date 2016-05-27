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
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    Edit Contact / Bareos Reporter
@endsection

@section('content-header')
    <h1>Edit Contact</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $contact->name }}</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <form class="form-edit-contact" method="POST" action="/contacts/save/{{ $contact->id }}">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name">Name:</label>
                                <input type="text" class="form-control" name="contact_name" value="{{ $contact->name }}"/>
                                @if ($errors->has('contact_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email Address:</label>
                                <input type="text" class="form-control" name="email" value="{{ $contact->email }}" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('contact_mobile') ? ' has-error' : '' }}">
                                <label for="contact_mobile">Mobile Number:</label>
                                <input type="text" class="form-control" name="contact_mobile" value="{{ $contact->mobile }}" />
                                @if ($errors->has('contact_mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-flat btn-primary"><strong>Save</strong></button>
                            </div>
                        </form>
                        <div class="form-group" style="margin-top: 15px;">
                            <button class="btn btn-flat btn-danger" data-record-id="{{ $contact->id }}" data-record-title="{{ $contact->name }}" data-toggle="modal" data-target="#confirm-contact-delete"><strong>Delete</strong></button>
                        </div>
                        <div class="modal fade" id="confirm-contact-delete" tabindex="-1" role="dialog" aria-labelledby="contactDelete" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="contactDelete">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to delete <b>{{ $contact->name }}</b>, this procedure is irreversible.</p>
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
                                    $('#confirm-contact-delete').on('click', '.btn-ok', function(e) {
                                        var $modalDiv = $(e.delegateTarget);
                                        var id = $(this).data('recordId');
                                        $(location).attr('href', '/contacts/delete/' + id);
                                    });
                                    $('#confirm-contact-delete').on('show.bs.modal', function(e) {
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
