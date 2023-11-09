<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/response.css">
</head>

<body>
    @extends('layouts.app')

    @section('title-block')
        Main page
    @endsection

    @section('content')
        <h1>{{ __('messages.main_page') }} </h1>
        <h3>{{ __('messages.posts_list') }}</h3>
        <a href='{{ route('sendExcel') }}'><button type="button" class="btn btn-primary">Send in excel format</button></a>

        <div class="cardsWithPosts">
            @if (isset($data) && $data->count() == 0)
                <p>There are no posts yet.</p>
            @elseif (isset($data))
                <div class="row mt-2">

                    @foreach ($data as $post)
                        @if (is_object($post))
                            <div class="col-md-10">
                                <div class="card border-danger mb-3" style="max-width: 1000px;">
                                    <div class="card-header">
                                        <p class="card-text">{{ $post->nickname }}</p>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><h6>{{$post->subject}}</h6></p>
                                        <p class="card-text">{{$post->message}}</p>
                                        <img src="{{ asset('storage/' . $post->post_image)}}" alt="" id="postImage">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{$data->links()}}
            @endif
        </div>
    

    @endsection
</body>

</html>
