@extends('layouts.app')

@section('title-block'){{$data->subject}}@endsection

@section('content')
<h1>{{$data->subject}}</h1>
<div class="alert alert-info">
    <div class="alert alert-info" style="max-width: 900px;">
        <p style="word-wrap: break-word;">{{$data->message }}</p>
    </div>
    
    <p>{{$name}}</p>
    <p><small>{{ $data->created_at}}</small></p>
    <a href="{{ route("updateMessage", $data->id)}}"><button type="button" class="btn btn-primary">{{__('messages.update')}}</button></a>
    <a href="{{ route("deleteMessage", $data->id)}}"><button type="button" class="btn btn-danger">{{__('messages.delete')}}</button></a>
</div>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@endsection
