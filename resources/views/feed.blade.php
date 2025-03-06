<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/feed.css">
</head>

<body>
    @extends('layouts.app')
    @section('content')
        @foreach ($data as $userItem)
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('OneUser', $userItem->id) }}">
                        <h5 class="card-title"> <img src="{{ asset('storage/' . $userItem->userInfos[0]->image) }}"
                                class="feedImage">{{ $userItem->nickname }}</h5>
                    </a>

                    <p class="card-text">Interests: {{ $userItem->userInfos[0]->interests }} </p>
                    <p class="card-text">Gender: {{ $userItem->userInfos[0]->gender }}</p>
                </div>
            </div>
        @endforeach
        {{ $data->links() }}
    @endsection
</body>

</html>
