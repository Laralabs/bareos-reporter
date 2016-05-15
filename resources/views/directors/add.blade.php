<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Add Director
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Add Director / Bareos Reporter</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Add Director</h3>
                </div>

                <div class="panel-body">
                    <form class="form-add-director" method="POST" action="/directors/create">
                        {!! csrf_field() !!}
                        <div class="col-xs-4">
                            <div class="section-heading">
                                <h4>Bareos Director Details</h4>
                                <hr />
                            </div>
                            <div class="form-group{{ $errors->has('director_name') ? ' has-error' : '' }}">
                                <label for="director_name">Director Name:</label>
                                <input type="text" class="form-control" name="director_name" value="{{ old('director_name') }}"/>
                                @if ($errors->has('director_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('director_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('director_ip') ? ' has-error' : '' }}">
                                <label for="director_ip">Director IP (FQDN):</label>
                                <input type="text" class="form-control" name="director_ip" value="{{ old('director_ip') }}"/>
                                @if ($errors->has('director_ip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('director_ip') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('director_port') ? ' has-error' : '' }}">
                                <label for="director_port">Director Port:</label>
                                <input type="text" class="form-control" name="director_port" placeholder="9101" value="{{ old('director_port') }}"/>
                                @if ($errors->has('director_port'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('director_port') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="section-heading" style="margin-top: 25px;">
                                <h4>Catalog Details</h4>
                                <hr />
                            </div>
                            <div class="form-group{{ $errors->has('catalog_name') ? ' has-error' : '' }}">
                                <label for="catalog_name">Catalog Name:</label>
                                <input type="text" class="form-control" name="catalog_name" value="{{ old('catalog_name') }}"/>
                                @if ($errors->has('catalog_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('catalog_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('driver') ? ' has-error' : '' }}">
                                <?php $databaseDriver = old('driver'); ?>
                                <label for="driver">Database Driver:</label>
                                <select id="driver-select" class="selectpicker form-control" name="driver">
                                    @if($databaseDriver == 'mysql')
                                        <option value="mysql" selected="selected">MySQL</option>
                                    @else
                                        <option value="mysql">MySQL</option>
                                    @endif
                                    @if($databaseDriver == 'pgsql')
                                        <option value="pgsql" selected="selected">PostgreSQL</option>
                                    @else
                                        <option value="pgsql">PostgreSQL</option>
                                    @endif
                                    @if($databaseDriver == 'sqlite')
                                        <option value="sqlite" selected="selected">SQLite</option>
                                    @else
                                        <option value="sqlite">SQLite</option>
                                    @endif
                                </select>
                                    @if ($errors->has('driver'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('driver') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div id="mysql-wrap">
                                <div class="form-group{{ $errors->has('host-mysql') ? ' has-error' : '' }}">
                                    <label for="host-mysql">Host:</label>
                                    <input type="text" class="form-control" name="host-mysql" value="{{ old('host-mysql') }}"/>
                                    @if ($errors->has('host-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('host-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('port-mysql') ? ' has-error' : '' }}">
                                    <label for="port-mysql">Port:</label>
                                    <input type="text" class="form-control" name="port-mysql" placeholder="3306" value="{{ old('port-mysql') }}"/>
                                    @if ($errors->has('port-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('port-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('database-mysql') ? ' has-error' : '' }}">
                                    <label for="database-mysql">Database:</label>
                                    <input type="text" class="form-control" name="database-mysql" value="{{ old('database-mysql') }}"/>
                                    @if ($errors->has('database-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('database-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('username-mysql') ? ' has-error' : '' }}">
                                    <label for="username-mysql">Username:</label>
                                    <input type="text" class="form-control" name="username-mysql" value="{{ old('username-mysql') }}"/>
                                    @if ($errors->has('username-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password-mysql') ? ' has-error' : '' }}">
                                    <label for="password-mysql">Password:</label>
                                    <input type="password" class="form-control" name="password-mysql" />
                                    @if ($errors->has('password-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('charset-mysql') ? ' has-error' : '' }}">
                                    <?php $charsetOld = old('charset-mysql'); ?>
                                    <label for="charset-mysql">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset-mysql">
                                        @if(!empty($mysql_charsets) && !empty($charsetOld))
                                            @foreach($mysql_charsets as $charset)
                                                @if($charset->CHARACTER_SET_NAME == $charsetOld)
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}" selected="selected">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @else
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @elseif(!empty($mysql_charsets))
                                            @foreach($mysql_charsets as $charset)
                                                @if($charset->CHARACTER_SET_NAME == 'utf8')
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}" selected="selected">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @else
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Charsets Loaded</option>
                                        @endif
                                    </select>
                                        @if ($errors->has('charset-mysql'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('charset-mysql') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('collation-mysql') ? ' has-error' : '' }}">
                                    <?php $collationOld = old('collation-mysql'); ?>
                                    <label for="collation-mysql">Collation:</label>
                                    <select id="collation-select" class="selectpicker form-control" name="collation-mysql">
                                        @if(!empty($mysql_charsets) && !empty($collationOld))
                                            @foreach($mysql_collations as $collation)
                                                @if($collation->COLLATION_NAME == $collationOld)
                                                    <option value="{{ $collation->COLLATION_NAME }}" selected="selected">{{ $collation->COLLATION_NAME }}</option>
                                                @else
                                                    <option value="{{ $collation->COLLATION_NAME }}">{{ $collation->COLLATION_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @elseif(!empty($mysql_collations))
                                            @foreach($mysql_collations as $collation)
                                                @if($collation->COLLATION_NAME == 'utf8_general_ci')
                                                    <option value="{{ $collation->COLLATION_NAME }}" selected="selected">{{ $collation->COLLATION_NAME }}</option>
                                                @else
                                                    <option value="{{ $collation->COLLATION_NAME }}">{{ $collation->COLLATION_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Collations Loaded</option>
                                        @endif
                                    </select>
                                        @if ($errors->has('collation-mysql'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('collation-mysql') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('prefix-mysql') ? ' has-error' : '' }}">
                                    <label for="prefix-mysql">Prefix:</label>
                                    <input type="text" class="form-control" name="prefix-mysql" value="{{ old('prefix-mysql') }}" />
                                    @if ($errors->has('prefix-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prefix-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('strict-mysql') ? ' has-error' : '' }}">
                                    <label for="strict-mysql">SQL Strict:</label>
                                    <select id="strict-select" class="selectpicker form-control" name="strict-mysql" >
                                        <option value="false" selected="selected">No</option>
                                        <option value="true">Yes</option>
                                    </select>
                                    @if ($errors->has('strict-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('strict-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <input type="hidden" class="form-control" name="engine" value="null" />
                            </div>
                            <div id="pgsql-wrap">
                                <div class="form-group{{ $errors->has('host-pgsql') ? ' has-error' : '' }}">
                                    <label for="host-pgsql">Host:</label>
                                    <input type="text" class="form-control" name="host-pgsql" value="{{ old('host-pgsql') }}"/>
                                    @if ($errors->has('host-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('host-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('port-pgsql') ? ' has-error' : '' }}">
                                    <label for="port-pgsql">Port:</label>
                                    <input type="text" class="form-control" name="port-pgsql" value="{{ old('port-pgsql') }}"/>
                                    @if ($errors->has('port-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('port-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('database-pgsql') ? ' has-error' : '' }}">
                                    <label for="database-pgsql">Database:</label>
                                    <input type="text" class="form-control" name="database-pgsql" value="{{ old('database-pgsql') }}"/>
                                    @if ($errors->has('database-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('database-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('username-pgsql') ? ' has-error' : '' }}">
                                    <label for="username-pgsql">Username:</label>
                                    <input type="text" class="form-control" name="username-pgsql" value="{{ old('username-pgsql') }}"/>
                                    @if ($errors->has('username-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password-pgsql') ? ' has-error' : '' }}">
                                    <label for="password-pgsql">Password:</label>
                                    <input type="password" class="form-control" name="password-pgsql" />
                                    @if ($errors->has('password-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('charset-pgsql') ? ' has-error' : '' }}">
                                    <?php $charsetOldPgSql = old('charset-pgsql'); ?>
                                    <label for="charset-pgsql">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset-pgsql">
                                        @if(!empty($pgsql_charsets) && !empty($charsetOldPgSql))
                                            @foreach($pgsql_charsets as $charset)
                                                @if($charset->name == $charsetOldPgSql)
                                                    <option value="{{ $charset->name }}" selected="selected">{{ $charset->name }}</option>
                                                @else
                                                    <option value="{{ $charset->name }}">{{ $charset->name }}</option>
                                                @endif
                                            @endforeach
                                        @elseif(!empty($pgsql_charsets))
                                            @foreach($pgsql_charsets as $charset)
                                                @if($charset->name == 'UTF8')
                                                    <option value="{{ $charset->name }}" selected="selected">{{ $charset->name }}</option>
                                                @else
                                                    <option value="{{ $charset->name }}">{{ $charset->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Charsets Loaded</option>
                                        @endif
                                    </select>
                                        @if ($errors->has('charset-pgsql'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('charset-pgsql') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('prefix-pgsql') ? ' has-error' : '' }}">
                                    <label for="prefix-pgsql">Prefix:</label>
                                    <input type="text" class="form-control" name="prefix-pgsql" value="{{ old('prefix-pgsql') }}"/>
                                    @if ($errors->has('prefix-pgsql'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prefix-pgsql') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('schema-pgsql') ? ' has-error' : '' }}">
                                    <label for="schema-pgsql">Schema:</label>
                                    <input type="text" class="form-control" name="schema-pgsql" placeholder="public" value="{{ old('schema-pgsql') }}"/>
                                    @if ($errors->has('schema-pgsql'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('schema-pgsql') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div id="sqlite-wrap">
                                <div class="form-group{{ $errors->has('database-sqlite') ? ' has-error' : '' }}">
                                    <label for="database-sqlite">Database Path:</label>
                                    <input type="text" class="form-control" name="database-sqlite" value="{{ old('database-sqlite') }}"/>
                                    @if ($errors->has('database-sqlite'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('database-sqlite') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('prefix-sqlite') ? ' has-error' : '' }}">
                                    <label for="prefix-sqlite">Prefix:</label>
                                    <input type="text" class="form-control" name="prefix-sqlite" value="{{ old('prefix-sqlite') }}"/>
                                    @if ($errors->has('prefix-sqlite'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prefix-sqlite') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary" style="margin-right: 10px;">Save</button>
                                <button type="submit" class="btn btn-info" disabled><i class="fa fa-btn fa-sign-in"></i>Test Connection</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
