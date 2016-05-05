<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * View Contacts
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Contacts / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Contacts</h3>
                </div>

                <div class="panel-body">
                    <div class="add-button">
                        <a href="/contacts/add"><button class="btn btn-primary" name="action" value="add">Add Contact</button></a>
                    </div>
                    <div class="contacts-wrap">
                        <table id="contacts-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->mobile }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $('#contacts-table').DataTable( {
                "iDisplayLength": 25
            });
        });
    })(jQuery);
</script>
@endsection
