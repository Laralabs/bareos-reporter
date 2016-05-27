@extends('layouts.auth')

@section('head-title')
    Bareos Reporter / Reset Password
@endsection

<!-- Main Content -->
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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

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

                        <div class="row text-center">
                            <button type="submit" class="btn btn-flat btn-primary">
                                <strong><i class="fa fa-btn fa-envelope"></i> Send Password Reset Link</strong>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
