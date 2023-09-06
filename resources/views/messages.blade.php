@extends('layouts.app')

@section('title-block')All posts @endsection
@section('content')
@section('caption')
    All messages
@endsection

@foreach ($data as $element)
<div class="alert alert-info">
    <h3>
        {{$element->subject}}
    </h3>
    <p>{{$element->email}}</p>
    <p><small>{{ $element->created_at}}</small></p>
    <a href="{{ route('contactDataOne', $element->id)}}"><button class="btn btn-warning">More</button></a>
</div>

@endforeach
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@endsection
