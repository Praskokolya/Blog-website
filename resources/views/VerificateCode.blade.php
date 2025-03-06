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
@include('includes.messages')
<body>
    <div class="container">
        <h6 class="mt-5">@lang('messages.almost-done')</h6>
        @if ($errors->any())
            <div class="alert alert-info mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('checkEmailCode') }}" method="post" maxlength="6">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">@lang('messages.your_code')</label>
                <input class="form-control" id="emailCode" name="UserEmailCode" placeholder="@lang('messages.enter_your_code')" maxlength="6">
            </div>
            <button type="submit" class="btn btn-success">@lang('messages.check_in')</button>
        </form>
    </div>
</body>

</html>
