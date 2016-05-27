@extends('layouts.auth')

@section('head-title')
    Bareos Reporter / Register
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <!-- Bareos Logo -->
            <a href="http://www.bareos.org/" style="text-decoration: none;">
                <img src="/images/bareos-full-logo.png" alt="Bareos Open Source Data Protection" class="bareos-logo" />
            </a>
            <!-- Bareos Logo End -->
            <h3><strong>Reporter</strong></h3>
        </div>
        <div class="login-box-body">
            <div class="box box-primary">
                <div class="box-header with-border"><strong>Register</strong></div>
                <div class="box-body">
                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="username-addon"><span class="fa fa-user" style="padding-right: 3px;"></span></span>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="name-addon"><span class="fa fa-user" style="padding-right: 3px;"></span></span>
                                <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="email-addon"><span class="fa fa-envelope"></span></span>
                                <input type="text" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="password-addon"><span class="fa fa-key"></span></span>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="password-confirmation-addon"><span class="fa fa-key"></span></span>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="row text-center">
                            <button type="submit" class="btn btn-flat btn-primary">
                                <strong><i class="fa fa-btn fa-user"></i> Register</strong>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
