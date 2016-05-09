<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Edit Template
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Edit Template / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Edit Template</h3>
                </div>

                <div class="panel-body">
                    <div class="col-xs-4">
                        <form class="form-edit-template" method="POST" action="/templates/save/{{ $template->id }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $template->name }}" />
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select id="frequency-select" class="selectpicker form-control" name="status">
                                    @if($template->status == 1)
                                        <option value="1" selected="selected">Enabled</option>
                                        <option value="0">Disabled</option>
                                    @else
                                        <option value="1">Enabled</option>
                                        <option value="0" selected="selected">Disabled</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="code">Template Code:</label>
                                <textarea class="form-control" name="code" style="resize: none;" rows="15">{{ $template->template_code }}</textarea>
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <div class="form-group" style="margin-top: 15px;">
                            <button class="btn btn-danger" data-record-id="{{ $template->id }}" data-record-title="{{ $template->name }}" data-toggle="modal" data-target="#confirm-template-delete">Delete</button>
                        </div>
                        <div class="modal fade" id="confirm-template-delete" tabindex="-1" role="dialog" aria-labelledby="templateDelete" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to delete <b>{{ $template->name }}</b>, this procedure is irreversible.</p>
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
                                    $('#confirm-template-delete').on('click', '.btn-ok', function(e) {
                                        var $modalDiv = $(e.delegateTarget);
                                        var id = $(this).data('recordId');
                                        $(location).attr('href', '/templates/delete/' + id);
                                    });
                                    $('#confirm-template-delete').on('show.bs.modal', function(e) {
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
