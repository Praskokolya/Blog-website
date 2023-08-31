@extends('layouts.app')

@section('title-block')
Обновление записей
@endsection

@section('content')
<h1>Обновление записей</h1>

<form action="{{ route('contactUpdateSubmit', $data->id) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Введите имя</label>
        <input type="text" name="name" value="{{$data->name}}"placeholder="Введите имя" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" value="{{$data->email}}" placeholder="Введите Email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="subject">Тема сообщения</label>
        <input type="subject" name="subject" value="{{$data->subject}}" placeholder="Тема сообщения" id="subject" class="form-control">
    </div>
    <div class="form-group">
        <label for="message">Сообщение</label>
        <textarea name="message" id="message" cols="10" rows="10" class="form-control" placeholder="Введите сообщение">{{$data->message}}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Обновить</button>
</form>
@endsection