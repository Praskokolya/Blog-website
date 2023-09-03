<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-block')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    @include('includes.header')

    @if(Request::is('/'))
        @include('includes.hero')
    @endif
    <div class="container mt-5">
        @include('includes.messages')
        <h1>@yield('caption')</h1>
        <div class="row">
            <div class="col-8">
                @yield('content')
            </div>
            <div class="col-4">
                @if(Request::is('contact/all'))
                   @include('includes.findPost')
                @endif
                @if(Request::is('contact/getPost'))
                   @include('includes.findPost')
                @endif
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>
</html>