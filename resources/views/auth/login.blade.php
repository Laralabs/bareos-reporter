@extends('layouts.auth')

@section('head-title')
    Bareos Reporter / Sign In
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
            <div class="box-header with-border"><strong>Login</strong></div>
            <div class="box-body">
                <form role="form" method="POST" action="{{ url('/login') }}">
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

                    <div class="row text-center">
                        <button type="submit" class="btn btn-flat btn-primary">
                            <strong><i class="fa fa-btn fa-sign-in"></i> Sign In</strong>
                        </button>
                    </div>

                    <div class="row text-center" style="margin-top: 5%;">
                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
