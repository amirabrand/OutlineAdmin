@extends('layouts.app')

@section('content')
    <section class="d-grid justify-content-center align-items-center" style="min-block-size: 60dvh">
        <form action="{{ route('auth.login.store') }}" method="post">
            @csrf

            <label for="password">{{ __('Password') }}</label>
            <input type="password" class="d-block my-1" id="password" name="password" placeholder="{{ __('Enter your password...') }}" size="32">
            @error('password') <small class="error-message">{{ $message }}</small> @enderror

            <div class="text-end">
                <button class="btn mt-1">{{ __('Login') }}</button>
            </div>
        </form>
    </section>
@endsection