@extends('layouts.app')

@section('title-block')
Contact page
@endsection

@section('content')
<h1>Contact page</h1>

<form action="{{ route('contact-form') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Your name</label>
        <input type="text" name="name" placeholder="Enter your name" id="name" class="form-control" value="{{ auth()->user()->nickname}}" readonly>
    </div>
    <div class="form-group">
        <label for="email">Your email</label>
        <input type="text" name="email" placeholder="Enter your email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
    </div>
    <div class="form-group">
        <label for="subject">Post subject</label>
        <input type="text" name="subject" placeholder="Post subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="10" rows="10" class="form-control" placeholder="Enter message"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Send</button>
</form>
@endsection
