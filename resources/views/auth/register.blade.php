@extends('layouts.app')

@section('content')
<div class="backgroundL">
    <img src="{{asset('figma/rightside.png')}}" class="figmaregL">
</div>
<div class="container">
    <div class="logo">
		<div class="logo__circle">
			<svg class="logo__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M20 9v9a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h13.8L.74 1.97 1.26.03 20 5.06V9zm-5 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM2 8v2h16V8H2zm1.5 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm5 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm6.5-1a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
		</div>
	</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form__control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form__control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                            <input id="phone" type="text" class="form__control @error('phone') is-invalid @enderror" name="phone" required >
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>
                                <div class="col-md-6">
                                    <select id="profession" type="text" class="form__control2 @error('profession') is-invalid @enderror" name="profession" required>
                                        <option>Teacher</option>
                                        <option>Student</option>
                                        <option>Other</option>
                                    </select>
                                @error('profession')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                                </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form__control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form__control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="form__button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="backgroundR">
    <img src="{{asset('figma/leftside.png')}}" class="figmaregR">
</div>
@endsection
