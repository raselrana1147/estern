<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Estran Tech - Register</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/app.css') }}" />
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="login">
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Register Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="" class="-intro-x flex items-center pt-5">
                <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('assets/admin/dist/images/logo.svg') }}">
                <span class="text-white text-lg ml-3"> Estran<span class="font-medium">Tech</span> </span>
            </a>
            <div class="my-auto">
                <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('assets/admin/dist/images/illustration.svg') }}">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                    A few more clicks to
                    <br>
                    sign up to your account.
                </div>
                <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">Manage all your accounts in one place</div>
            </div>
        </div>
        <!-- END: Register Info -->
        <!-- BEGIN: Register Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Sign Up
                </h2>
                <div class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your accounts in one place</div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="intro-x mt-8">
                        <input type="text" name="name" class="@error('name') is-invalid @enderror intro-x login__input form-control py-3 px-4 border-gray-300 block" placeholder="Full Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="email" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="number" name="phone" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="intro-x w-full grid grid-cols-12 gap-4 h-1 mt-3">
                            <div class="col-span-3 h-full rounded bg-theme-9"></div>
                            <div class="col-span-3 h-full rounded bg-theme-9"></div>
                            <div class="col-span-3 h-full rounded bg-theme-9"></div>
                            <div class="col-span-3 h-full rounded bg-gray-200 dark:bg-dark-2"></div>
                        </div>
                        <a href="" class="intro-x text-gray-600 block mt-2 text-xs sm:text-sm">What is a secure password?</a>
                        <input type="text" name="password_confirmation" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Password Confirmation">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm">
                        <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                        <label class="cursor-pointer select-none" for="remember-me">I agree to the Estran Tech</label>
                        <a class="text-theme-1 dark:text-theme-10 ml-1" href="">Privacy Policy</a>.
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Register Form -->
    </div>
</div>

<!-- BEGIN: JS Assets-->
<script src="{{ asset('assets/admin/dist/js/app.js') }}"></script>
<!-- END: JS Assets-->
</body>
</html>
