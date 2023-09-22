@extends('layouts.app')

@section('title-block')Main page @endsection

@section('content')
    <h1>{{__('messages.main_page')}} </h1>
    <h3>{{__('messages.posts_list')}}</h3>
    <div class="cardsWithPosts">
        @if (isset($data) && $data->count() == 0)
        <p>There are no posts yet.</p>
    @elseif (isset($data))
        <div class="row">
            @foreach ($data as $post)
            @if (is_object($post))
            <div class="col-md-4">
                <div class="card border-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                        <p class="card-text">{{$post->nickname}}</p>
                    </div>
                    <div class="card-body text-danger">
                      <p class="card-text">{{$post->message}}</p>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    @endif
    </div>
@endsection
