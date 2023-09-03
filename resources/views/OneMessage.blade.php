@extends('layouts.app')

@section('title-block'){{$data->subject}}@endsection

@section('content')
<h1>{{$data->subject}}</h1>
<div class="alert alert-info">
    <p>{{$data->message }}</p>
    <p>{{$data->email}}</p>
    <p><small>{{ $data->created_at}}</small></p>
    <a href="{{ route("postMessage", $data->id)}}"><button type="button" class="btn btn-success">Запостить</button></a>
    <a href="{{ route("updateMessage", $data->id)}}"><button type="button" class="btn btn-primary">Редактировать</button></a>
    <a href="{{ route("deleteMessage", $data->id)}}"><button type="button" class="btn btn-danger">Удалить</button></a>
</div>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@endsection
