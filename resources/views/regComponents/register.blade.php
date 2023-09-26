<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/registrationForm.css">
    <title>Document</title>
</head>
<html lang="en">
<body>
    <div class="container">
        <h2 class="mt-5">@lang('messages.welcome')</h2>
    
        @if($errors->any())
            <div class="alert alert-info mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('registerAccount') }}" method="GET">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">@lang('messages.your_name')</label>
                <input type="text" class="form-control" name="nickname" id="username" placeholder="@lang('messages.enter_your_name')">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">@lang('messages.your_email')</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="@lang('messages.enter_your_email')">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">@lang('messages.enter_password')</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="@lang('messages.enter_password')">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">@lang('messages.confirm_password')</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="@lang('messages.confirm_password')" required>
            </div>
            <button type="submit" class="btn btn-success">@lang('messages.check_in')</button>
        </form>
    </div>
</body>
</html>

