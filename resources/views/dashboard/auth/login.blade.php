@extends('dashboard.layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/icheck/icheck.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/icheck/custom.css') }}?v={{ config('app.version') }}">
    <style type="text/css">
        .card-header {
            padding: 0;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('assets/vendors/js/forms/icheck/icheck.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            'use strict';
            if($('.chk-remember').length){
                $('.chk-remember').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                });
            }
        });
    </script>
@endsection

@section('content')
    <section class="flexbox-container">
        <div class="col-12 d-flex justify-content-center">
            <div class="col-md-4 col-12 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center pb-1">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="{{ $settings['title'] }}" height="100">
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-1">
                            <span>Login</span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('login') }}" method="post">
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text" placeholder="E-mail" name="email" value="{{ old('email') }}" class="form-control" autofocus="" autocomplete="off" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block m-b-none text-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                    <div class="form-control-position">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" placeholder="password" name="password" class="form-control" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block m-b-none text-danger">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                    <div class="form-control-position">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-md-12 col-12 text-left">
                                        <fieldset>
                                            <input type="checkbox" name="remember" id="remember" class="chk-remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember" class="primary"> Remember me !</label>
                                        </fieldset>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                LogIn <i class="fa fa-unlock"></i> 
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection