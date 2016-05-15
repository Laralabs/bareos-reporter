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
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head')
    <title>Edit {{ $director->director_name }} / Bareos Reporter</title>
@endsection
<?php
        $enc_password = $catalog->password;
        if(!empty($enc_password))
        {
            $password = \Illuminate\Support\Facades\Crypt::decrypt($catalog->password);
        }
?>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Edit {{ $director->director_name }}</h3>
                </div>

                <div class="panel-body">
                    <div class="col-xs-4">
                        <form class="form-add-director" method="POST" action="/directors/save/{{ $director->id }}">
                            {!! csrf_field() !!}
                            <input type="hidden" id="driver_check" name="driver_check" value="{{ $catalog->driver }}" />
                            <div class="section-heading">
                                <h4>Bareos Director Details</h4>
                                <hr />
                            </div>
                            <div class="form-group{{ $errors->has('director_name') ? ' has-error' : '' }}">
                                <label for="director_name">Director Name:</label>
                                <input type="text" class="form-control" name="director_name" value="{{ $director->director_name }}" />
                                @if ($errors->has('director_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('director_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('director_ip') ? ' has-error' : '' }}">
                                <label for="director_ip">Director IP (FQDN):</label>
                                <input type="text" class="form-control" name="director_ip" value="{{ $director->ip_address }}" />
                                @if ($errors->has('director_ip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('director_ip') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('director_port') ? ' has-error' : '' }}">
                                <label for="director_port">Director Port:</label>
                                <input type="text" class="form-control" name="director_port" placeholder="9101" value="{{ $director->director_port }}" />
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
                                <input type="text" class="form-control" name="catalog_name" value="{{ $catalog->name }}"/>
                                @if ($errors->has('catalog_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('catalog_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('driver') ? ' has-error' : '' }}">
                                <label for="driver">Database Driver:</label>
                                <select id="driver-select" class="selectpicker form-control" name="driver">
                                    @if($catalog->driver == 'mysql')
                                        <option value="mysql" selected="selected">MySQL</option>
                                    @else
                                        <option value="mysql">MySQL</option>
                                    @endif
                                    @if($catalog->driver == 'pgsql')
                                        <option value="pgsql" selected="selected">PostgreSQL</option>
                                    @else
                                        <option value="pgsql">PostgreSQL</option>
                                    @endif
                                    @if($catalog->driver == 'sqlite')
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
                                    <label for="host">Host:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="host-mysql" value="{{ $catalog->host }}" />
                                    @else
                                        <input type="text" class="form-control" name="host-mysql" />
                                    @endif
                                    @if ($errors->has('host-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('host-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('port-mysql') ? ' has-error' : '' }}">
                                    <label for="port">Port:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="port-mysql" placeholder="3306" value="{{ $catalog->port }}" />
                                    @else
                                        <input type="text" class="form-control" name="port-mysql" placeholder="3306" />
                                    @endif
                                    @if ($errors->has('port-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('port-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('database-mysql') ? ' has-error' : '' }}">
                                    <label for="database">Database:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="database-mysql" value="{{ $catalog->database }}" />
                                    @else
                                        <input type="text" class="form-control" name="database-mysql" />
                                    @endif
                                    @if ($errors->has('database-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('database-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('username-mysql') ? ' has-error' : '' }}">
                                    <label for="username">Username:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="username-mysql" value="{{ $catalog->username }}" />
                                    @else
                                        <input type="text" class="form-control" name="username-mysql" />
                                    @endif
                                    @if ($errors->has('username-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password-mysql') ? ' has-error' : '' }}">
                                    <label for="password">Password:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="password" class="form-control" name="password-mysql" value="{{ $password }}" />
                                    @else
                                        <input type="password" class="form-control" name="password-mysql" />
                                    @endif
                                    @if ($errors->has('password-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('charset-mysql') ? ' has-error' : '' }}">
                                    <label for="charset">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset-mysql">
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
                                    @if ($errors->has('charset-mysql'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('charset-mysql') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('collation-mysql') ? ' has-error' : '' }}">
                                    <label for="collation">Collation:</label>
                                    <select id="collation-select" class="selectpicker form-control" name="collation-mysql">
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
                                    @if ($errors->has('collation-mysql'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('collation-mysql') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('prefix-mysql') ? ' has-error' : '' }}">
                                    <label for="prefix">Prefix:</label>
                                    @if($catalog->driver == 'mysql')
                                        <input type="text" class="form-control" name="prefix-mysql" value="{{ $catalog->prefix }}" />
                                    @else
                                        <input type="text" class="form-control" name="prefix-mysql" />
                                    @endif
                                    @if ($errors->has('prefix-mysql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('prefix-mysql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('strict-mysql') ? ' has-error' : '' }}">
                                    <label for="strict">SQL Strict:</label>
                                    <select id="strict-select" class="selectpicker form-control" name="strict-mysql" >
                                        @if($catalog->strict == 0)
                                            <option value="0" selected="selected">No</option>
                                        @elseif($catalog->strict == 1)
                                            <option value="1" selected="selected">Yes</option>
                                        @else
                                            <option value="0" selected="selected">No</option>
                                        @endif
                                        <option value="1">Yes</option>
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
                                    <label for="host">Host:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="host-pgsql" value="{{ $catalog->host }}" />
                                    @else
                                        <input type="text" class="form-control" name="host-pgsql" />
                                    @endif
                                    @if ($errors->has('host-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('host-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('port-pgsql') ? ' has-error' : '' }}">
                                    <label for="port">Port:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="port-pgsql" value="{{ $catalog->port }}" />
                                    @else
                                        <input type="text" class="form-control" name="port-pgsql" />
                                    @endif
                                    @if ($errors->has('port-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('port-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('database-pgsql') ? ' has-error' : '' }}">
                                    <label for="database">Database:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="database-pgsql" value="{{ $catalog->database }}" />
                                    @else
                                        <input type="text" class="form-control" name="database-pgsql" />
                                    @endif
                                    @if ($errors->has('database-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('database-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('username-pgsql') ? ' has-error' : '' }}">
                                    <label for="username">Username:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="username-pgsql" value="{{ $catalog->username }}" />
                                    @else
                                        <input type="text" class="form-control" name="username-pgsql" />
                                    @endif
                                    @if ($errors->has('username-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password-pgsql') ? ' has-error' : '' }}">
                                    <label for="password">Password:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="password" class="form-control" name="password-pgsql" value="{{ $password }}" />
                                    @else
                                        <input type="password" class="form-control" name="password-pgsql" />
                                    @endif
                                    @if ($errors->has('password-pgsql'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password-pgsql') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('charset-pgsql') ? ' has-error' : '' }}">
                                    <label for="charset">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset-pgsql">
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
                                    @if ($errors->has('charset-pgsql'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('charset-pgsql') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('prefix-pgsql') ? ' has-error' : '' }}">
                                    <label for="prefix">Prefix:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="prefix-pgsql" value="{{ $catalog->prefix }}" />
                                    @else
                                        <input type="text" class="form-control" name="prefix-pgsql" />
                                    @endif
                                    @if ($errors->has('prefix-pgsql'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prefix-pgsql') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('schema-pgsql') ? ' has-error' : '' }}">
                                    <label for="schema">Schema:</label>
                                    @if($catalog->driver == 'pgsql')
                                        <input type="text" class="form-control" name="schema" value="{{ $catalog->schema }}" />
                                    @else
                                        <input type="text" class="form-control" name="schema" value="public" />
                                    @endif
                                    @if ($errors->has('schema-pgsql'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('schema-pgsql') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div id="sqlite-wrap">
                                <div class="form-group{{ $errors->has('database-sqlite') ? ' has-error' : '' }}">
                                    <label for="database">Database Path:</label>
                                    @if($catalog->driver == 'sqlite')
                                        <input type="text" class="form-control" name="database-sqlite" value="{{ $catalog->database }}" />
                                    @else
                                        <input type="text" class="form-control" name="database-sqlite" />
                                    @endif
                                    @if ($errors->has('database-sqlite'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('database-sqlite') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('prefix-sqlite') ? ' has-error' : '' }}">
                                    <label for="prefix">Prefix:</label>
                                    @if($catalog->driver == 'sqlite')
                                        <input type="text" class="form-control" name="prefix-sqlite" value="{{ $catalog->prefix }}" />
                                    @else
                                        <input type="text" class="form-control" name="prefix-sqlite" />
                                    @endif
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
                        </form>
                        <div class="form-group" style="margin-top: 15px;">
                            <button class="btn btn-danger" data-record-id="{{ $director->id }}" data-record-title="{{ $director->director_name }}" data-toggle="modal" data-target="#confirm-director-delete">Delete</button>
                        </div>
                        <div class="modal fade" id="confirm-director-delete" tabindex="-1" role="dialog" aria-labelledby="directorDelete" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="directorDelete">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to delete <b>{{ $director->director_name }}</b>, this procedure is irreversible.</p>
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
                                    $('#confirm-director-delete').on('click', '.btn-ok', function(e) {
                                        var $modalDiv = $(e.delegateTarget);
                                        var id = $(this).data('recordId');
                                        $(location).attr('href', '/directors/delete/' + id);
                                    });
                                    $('#confirm-director-delete').on('show.bs.modal', function(e) {
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
