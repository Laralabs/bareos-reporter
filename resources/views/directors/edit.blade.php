<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Edit Director
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 */
?>
@extends('layouts.app')

@section('head')
    <title>Edit {{ $director->director_name }} / Bareos Reporter</title>
@endsection
<?php
        $password = \Illuminate\Support\Facades\Crypt::decrypt($catalog->password);
?>
@section('content')
<div class="container content-container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Edit {{ $director->director_name }}</h3>
                </div>

                <div class="panel-body">
                    <form class="form-add-director" method="POST" action="/directors/save/{{ $director->id }}">
                        {!! csrf_field() !!}
                        <div class="col-xs-4">
                            <div class="section-heading">
                                <h4>Bareos Director Details</h4>
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="director_name">Director Name:</label>
                                <input type="text" class="form-control" name="director_name" value="{{ $director->director_name }}" />
                            </div>
                            <div class="form-group">
                                <label for="director_ip">Director IP (FQDN):</label>
                                <input type="text" class="form-control" name="director_ip" value="{{ $director->ip_address }}" />
                            </div>
                            <div class="form-group">
                                <label for="director_port">Director Port:</label>
                                <input type="text" class="form-control" name="director_port" placeholder="9101" value="{{ $director->director_port }}" />
                            </div>

                            <div class="section-heading" style="margin-top: 25px;">
                                <h4>Catalog Details</h4>
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="catalog_name">Catalog Name:</label>
                                <input type="text" class="form-control" name="catalog_name" value="{{ $catalog->name }}"/>
                            </div>
                            <div class="form-group">
                                <label for="driver">Database Driver:</label>
                                <select id="driver-select" class="selectpicker form-control" name="driver">
                                    <option value="mysql">MySQL</option>
                                    <option value="pgsql">PostgreSQL</option>
                                    <option value="sqlite">SQLite</option>
                                </select>
                            </div>
                            <div id="mysql-wrap">
                                <div class="form-group">
                                    <label for="host">Host:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="host[]" value="{{ $catalog->host }}" />
                                    @else
                                        <input type="text" class="form-control" name="host[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="port">Port:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="port[]" placeholder="3306" value="{{ $catalog->port }}" />
                                    @else
                                        <input type="text" class="form-control" name="port[]" placeholder="3306" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="database">Database:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="database[]" value="{{ $catalog->database }}" />
                                    @else
                                        <input type="text" class="form-control" name="database[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="username[]" value="{{ $catalog->username }}" />
                                    @else
                                        <input type="text" class="form-control" name="username[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="password" class="form-control" name="password[]" value="{{ $password[0] }}" />
                                    @else
                                        <input type="password" class="form-control" name="password[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="charset">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset[]">
                                        @if(!empty($mysql_charsets))
                                            @foreach($mysql_charsets as $charset)
                                                @if($charset->CHARACTER_SET_NAME == $catalog->charset)
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}" selected="selected">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @else
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Charsets Loaded</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="collation">Collation:</label>
                                    <select id="collation-select" class="selectpicker form-control" name="collation[]">
                                        @if(!empty($mysql_collations))
                                            @foreach($mysql_collations as $collation)
                                                @if($collation->COLLATION_NAME == $catalog->collation)
                                                    <option value="{{ $collation->COLLATION_NAME }}" selected="selected">{{ $collation->COLLATION_NAME }}</option>
                                                @else
                                                    <option value="{{ $collation->COLLATION_NAME }}">{{ $collation->COLLATION_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Collations Loaded</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prefix">Prefix:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="prefix[]" value="{{ $catalog->prefix }}" />
                                    @else
                                        <input type="text" class="form-control" name="prefix[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="strict">SQL Strict:</label>
                                    <select id="strict-select" class="selectpicker form-control" name="strict[]" >
                                        @if($catalog->strict == 0)
                                            <option value="0" selected="selected">No</option>
                                        @elseif($catalog->strict == 1)
                                            <option value="1" selected="selected">Yes</option>
                                        @else
                                            <option value="0" selected="selected">No</option>
                                        @endif
                                            <option value="1">Yes</option>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" name="engine" value="null" />
                            </div>
                            <div id="pgsql-wrap">
                                <div class="form-group">
                                    <label for="host">Host:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="host[]" value="{{ $catalog->host }}" />
                                    @else
                                        <input type="text" class="form-control" name="host[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="port">Port:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="port[]" value="{{ $catalog->port }}" />
                                    @else
                                        <input type="text" class="form-control" name="port[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="database">Database:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="database[]" value="{{ $catalog->database }}" />
                                    @else
                                        <input type="text" class="form-control" name="database[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="username[]" value="{{ $catalog->username }}" />
                                    @else
                                        <input type="text" class="form-control" name="username[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="password" class="form-control" name="password[]" value="{{ $password[0] }}" />
                                    @else
                                        <input type="password" class="form-control" name="password[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="charset">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset[]">
                                        @if(!empty($pgsql_charsets))
                                            @foreach($pgsql_charsets as $charset)
                                                @if($charset->name == $catalog->charset)
                                                    <option value="{{ $charset->name }}" selected="selected">{{ $charset->name }}</option>
                                                @else
                                                    <option value="{{ $charset->name }}">{{ $charset->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Charsets Loaded</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prefix">Prefix:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="prefix[]" value="{{ $catalog->prefix }}" />
                                    @else
                                        <input type="text" class="form-control" name="prefix[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="schema">Schema:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="schema" value="{{ $catalog->schema }}" />
                                    @else
                                        <input type="text" class="form-control" name="schema" value="public" />
                                    @endif
                                </div>
                            </div>
                            <div id="sqlite-wrap">
                                <div class="form-group">
                                    <label for="database">Database Path:</label>
                                    @if($catalog->driver == 'sqlite')
                                        <input type="text" class="form-control" name="database[]" value="{{ $catalog->database }}" />
                                    @else
                                        <input type="text" class="form-control" name="database[]" />
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="prefix">Prefix:</label>
                                    @if($catalog->driver == 'sqlite')
                                        <input type="text" class="form-control" name="prefix[]" value="{{ $catalog->prefix }}" />
                                    @else
                                        <input type="text" class="form-control" name="prefix[]" />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary btn-lg" style="margin-right: 10px;">Save</button>
                                <button type="submit" class="btn btn-info btn-lg" disabled><i class="fa fa-btn fa-sign-in"></i>Test Connection</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
