@extends('layouts.auth')

@section('content')
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="account-bg">
            <div class="card-box mb-0">
                <div class="m-t-10 p-20">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12">
                                @error('email')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                                <input id="email" type="email" placeholder="{{ __('Email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                @error('password')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row m-t-10">
                            <div class="col-12">
                                <button class="btn btn-success btn-block waves-effect waves-light" type="submit">{{ __('Login') }}</button>
                            </div>
                        </div>

                    </form>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
