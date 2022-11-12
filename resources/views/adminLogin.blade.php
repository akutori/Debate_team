@extends('test')
@section('head')
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <script src="{{ asset('js/newAcount.js') }}"></script>
    <style>
        .hidden{
            display: none;
        }
    </style>
@endsection
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/login.js')}}">
    <link rel="stylesheet" href="{{asset('js/genre.js')}}">

@section('body')

    <div id="particles-js"></div>
    <div class="container">

        <div id="wrapper">
            <div class="card col-md-8">

                <div class="bg-info " style="font-size: large ">{{ __('Register your information') }}</div>

                <div class="login card-body">
                    <form method="post" action="{{ url('/admin') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <label for="id" class="col-md-4 col-form-label text-md-end">ユーザーID</label>
                            <div class="group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus onchange="acount()">
                                <label for="floatingInput">Name</label>
                            </div>
                            <div class="col-md-6">
                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">
                                <label for="floatingInput">Password</label>
                                <div class="col-md-6">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0 group">
                                <div class="form-check container-fluid">
                                    <input class="form-check-input "  type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <div class="form-check-label " for="remember">
                                        {{ __('Remember Me') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid row mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>


                        <a class="hidden btn btn-link" id="newAcount" href="{{ url('adminNewAcount') }}">
                            {{ __('Do you have an Adomin acount?') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src={{asset('js/genre.js')}}></script>
    <script src={{ asset('js/newAcount.js') }}></script>

@endsection




