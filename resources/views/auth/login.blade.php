{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}


@extends('apps.master')

@section('title')
    WEBNS | Admin Login
@endsection

@section('content')

    <div class="container py-5">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row g-2 justify-content-center">
                <div class="col-md-6">

                    <div class="card p-3 my-5 back-gradient-yellow">
                        <div class="col-md-12 text-center py-3">
                            <h2 class="h1 fw-bold text-white">Login</h2>
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="email" name="email" style="height: 5px;" class="form-control shadow-none" id="email" :value="old('email')" placeholder="Enter your email" required autocomplete="username" />
                                <label for="email" style="color: rgba(105,105,105,0.8)!important;">Email</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-12 mt-4">
                            <div class="form-floating">
                                <input type="password" name="password" style="height: 5px;" class="form-control shadow-none" id="password" :value="old('email')" placeholder="Enter your password" required autocomplete="current-password" />
                                <label for="password" style="color: rgba(105,105,105,0.8)!important;">Password</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded shadow-sm" name="remember">
                                <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="d-flex justify-content-between items-center justify-end mt-3">
                            @if (Route::has('password.request'))
                                <a class="text-white my-auto" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <button type="submit" class="btn border-white border-2 text-white">
                                Log in
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


