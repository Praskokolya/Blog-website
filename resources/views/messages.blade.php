@extends('layouts.app')

@section('title-block')All posts @endsection
@section('content')
@section('caption')
    {{__('messages.all_messages')}}
@endsection
<a href='{{route("sendUserExcel")}}'><button type="button" class="btn btn-success">Send in excel format</button></a>
@foreach ($data as $element)
<div class="alert alert-info">
    <h3>
        {{$element->subject}}
    </h3>
    <p>{{$element->email}}</p>
    <p><small>{{ $element->created_at}}</small></p>
    <a href="{{ route('contactDataOne', $element->id)}}"><button class="btn btn-warning">{{__('messages.more')}}</button></a>
</div>
@endforeach

    
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@endsection
