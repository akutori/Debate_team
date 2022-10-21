@extends('header')
@section('head')

@endsection

@section('body')
<div id="particles-js"></div>
<div class="container">


    <div class="card-header">{{ __('create admin account') }}</div>

        <div class="card-body register">

            <form method="POST" action="{{ url('makeAcount') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                    <div class="group">

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>

                    <div class="col-md-6">

                        <div class="group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <label>Password</label>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                    <div class="group2">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <label>Confirm Password</label>
                    </div>
                </div>

                <div class="row mb-0">

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">{{ __('makeAcount') }}
                            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
