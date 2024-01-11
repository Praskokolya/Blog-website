<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/response.css">
    <script src="public\js\script.js"></script>
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
                            <div class="col-md-10" id="{{ $post->contact_id }}">
                                <div class="card border-danger mb-3" style="height: 95%">
                                    <a href="{{ route('OneUser', $post->user_id) }}">
                                        <div class="card-header">
                                            @if ($post->image == null)
                                                @php
                                                    $post->image = 'photos/without_picture.png';
                                                @endphp
                                            @endif
                                            <p class="card-text"><img src="{{ asset('storage/' . $post->image) }}"
                                                    alt="" class="img-fluid rounded-circle" id="avatarPost">
                                                {{ $post->nickname }}
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        {{ $post->post_id }}
                                        <p class="card-text">
                                        <h6>{{ $post->subject }}</h6>
                                        </p>
                                        <p class="card-text">{{ $post->message }}</p>
                                        <p><img src="{{ asset('storage/' . $post->post_image) }}" alt=""
                                                id="postImage"></p>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Your response"
                                                id="form" aria-label="" aria-describedby="basic-addon2">
                                        </div>
                                        @if (Auth::check())
                                            <button class="btn btn-outline-secondary" id="Response" type="button"
                                                onclick="ShowResponseInput({{ $post->contact_id }})">Respond</button>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{ $data->links() }}
            @endif
        </div>


    @endsection
</body>
<script src="{{ asset('js/script.js') }}"></script>

</html>
