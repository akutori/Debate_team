@extends('test')

@section('head')

    <link rel="stylesheet" href="{{asset('js/register.js')}}">
    <link rel="stylesheet" href="{{asset('js/genre.js')}}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">


@section('body')
    <div id="particles-js"></div>
    <div class="container">

        <div id="wrapper">
            <div class="col-md-8">
                <div class="card">

                    <div class="text-bg-info " style="font-size: large ">{{ __('Register your information') }}</div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-3">


                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label for="floatingInput">Name</label>

                                <div class="col-md-6">
                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>

                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    <label>Password</label>

                                <div class="col-md-6">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="group">
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label " for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src={{asset('js/genre.js')}}></script>
@endsection
