@extends('layout.master')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm" style="width: 350px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">{{__('messages.login')}}</h3>

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="username">{{ __('messages.username') }}</label>
                    <input
                        type="text"
                        class="form-control form-control-sm @error('username') is-invalid @enderror"
                        id="username"
                        name="username"
                        placeholder="{{ __('messages.enter username') }}">
                    <!-- Error message -->
                    @error('username')
                        <span class="text-danger">{{ __('messages.validation.username_required') }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">{{ __('messages.password') }}</label>
                    <input
                        type="password"
                        class="form-control form-control-sm @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="{{ __('messages.enter password') }}">
                    <!-- Error message -->
                    @error('password')
                        <span class="text-danger">{{ __('messages.validation.password_required') }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-sm w-100">{{ __('messages.login') }}</button>
            </form>

            <!-- Error message for invalid credentials -->
            @if($errors->has('credentials'))
                <div class="alert alert-danger mt-3">
                    {{ $errors->first('credentials') }}
                </div>
            @endif

            <p class="mt-3 text-center">
                {{__('messages.do not have an account?')}} <a href="{{ route('register.create') }}">{{__('messages.register here')}}</a>.
            </p>
        </div>
    </div>
</div>
@endsection
