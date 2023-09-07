@extends('layouts.app')

@section('title-block')
Обновление записей
@endsection

@section('content')
<h1>Обновление записей</h1>

<form action="{{ route('contactUpdateSubmit', $data->id) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Your name</label>
        <input type="text" name="name" placeholder="Your name" id="name" class="form-control" value="{{ auth()->user()->nickname }}" readonly>
    </div>
    <div class="form-group">
        <label for="email">Your email</label>
        <input type="text" name="email" placeholder="Enter your email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
    </div>
    <div class="form-group">
        <label for="subject">Post subject</label>
        <input type="subject" name="subject" value="{{$data->subject}}" placeholder="Post subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="10" rows="10" class="form-control" placeholder="Message">{{$data->message}}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button> 
    {{-- my comment super great --}}
</form>
@endsection  