@extends('layouts.app')

@section('title-block')Main page @endsection

@section('content')
    <h1>Main page</h1>
    <p>
        Our website is a convenient platform to publish your posts on the homepage. You can share your thoughts, news, ideas and more with our community. Simply create an account, write your post and share it with the world. You have a voice - let it be heard!</p>
    <h3>Posts list</h3>
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
                        <p class="card-text">{{$post->subject}}</p>
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
