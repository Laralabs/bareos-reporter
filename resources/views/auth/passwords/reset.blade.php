@extends('layouts.auth')

@section('head-title')
    Bareos Reporter / Reset Password
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
                <div class="box-header with-border"><strong>Reset Password</strong></div>
                <div class="box-body">
                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon" id="email-addon"><span class="fa fa-envelope"></span></span>
                                <input type="text" class="form-control" name="email" placeholder="Email Address" value="{{ $email or old('email') }}">
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
                                <strong><i class="fa fa-btn fa-refresh"></i> Reset Password</strong>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
