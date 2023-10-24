<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <a href="{{ route('home') }}" class="my-0 mr-md-auto font-weight-normal" id='Corp'>
            <h5>Corporation</h5>
        </a>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('contactData') }}">Feed</a>
            <a class="p-2 text-dark" href="{{ route('home') }}">{{ __('messages.main') }}</a>
            <a class="p-2 text-dark" href="{{ route('contact') }}">{{ __('messages.add_message') }}</a>
            <a class="p-2 text-dark" href="{{ route('about') }}">{{ __('messages.about') }}</a>
            <a class="p-2 text-dark" href="{{ route('contactData') }}">{{ __('messages.all_messages') }}</a>
        </nav>
        @if (Auth::check())
            <a class="p-2 text-dark" href="{{ route('logoutAccount') }}">{{ __('messages.logout') }}</a>
            <div class=""><a href="{{route("userProfile")}}"><b>{{ Auth::user()->nickname }}</b></a></div>
        @else
            <div class="mr-1"><a class="btn btn-outline-primary"
                    href="{{ route('authForm') }}">{{ __('messages.sign_up') }}</a></div>
        @endif
        <a href="{{ route('changeLanguage', __('messages.set_lang')) }}">
            {{ __('messages.set_lang') }}
        </a>
    </div>
</body>
</html>
