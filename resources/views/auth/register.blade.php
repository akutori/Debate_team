@extends('test')
@section('head')

    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <link rel="stylesheet" href="{{asset('js/register.js')}}">
    <link rel="stylesheet" href="{{asset('js/genre.js')}}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">






@section('body')
    <div id="particles-js"></div>
    <div class="container">

        <div id="wrapper">
            <div class="col-md-8">
                <div class="card">

                    <div class="bg-info " style="font-size: large ">{{ __('Register your information') }}</div>

                    <div class="card-body">
                        <div class="lo">
                            <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!--名前-->
                                <div class="form-floating mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                                    <div class="group">

                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <label>Name</label>
                                    </div>

                                    <div class="col-md-6">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- パスワード -->
                                <div class="form-floating mb-3">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                                    <div class="group">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="new-password">
                                        <label>Password</label>


                                    <div class="col-md-6">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>



                                <div class="form-floating mb-3">
                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                                    <div class="group">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                        <label>Confirm Password</label>
                                    </div>
                                </div>

                                <div class="row mb-0">

                                    <div class="container-fluid">
                                        <button type="submit" class="btn btn-primary ">{{ __('Register') }}

                                        </button>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src={{asset('js/genre.js')}}></script>

@endsection


