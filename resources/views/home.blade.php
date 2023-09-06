@extends('layouts.app')

@section('title-block')Главная страница@endsection

@section('content')
    <h1>Главная страница</h1>
    <p>
        Наш сайт - это удобная платформа для публикации ваших сообщений на главной странице. Вы можете делиться своими мыслями, новостями, идеями и многим другим с нашим сообществом. Просто создайте аккаунт, напишите свое сообщение и поделитесь им с миром. У вас есть голос - дайте ему звучать!</p>
    <h3>Список постов</h3>
    <div class="cardsWithPosts">
        @if (isset($data) && $data->count() == 0)
        <p>Пока нет записей.</p>
    @elseif (isset($data))
        <div class="row">
            @foreach ($data as $post)
            @if (is_object($post))
            <div class="col-md-4">
                <div class="card border-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{$post->subject}}
                        {{$post->name}}
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
