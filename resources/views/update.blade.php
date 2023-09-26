@extends('layouts.app')

@section('title-block')
{{ __('messages.update_posts') }}
@endsection

@section('content')
<h1>{{ __('messages.update_posts') }}</h1>

<form action="{{ route('contactUpdateSubmit', $data->id) }}" method="post">
    @csrf
    <div class="form-group">
        <label for="subject">{{ __('messages.post_subject') }}</label>
        <input type="subject" name="subject" value="{{ $data->subject }}" placeholder="{{ __('messages.post_subject') }}" id="subject" class="form-control">
    </div>
    <div class="form-group">
        <label for="message">{{ __('messages.message') }}</label>
        <textarea name="message" id="message" cols="10" rows="10" class="form-control" placeholder="{{ __('messages.enter_message') }}">{{ $data->message }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">{{ __('messages.update') }}</button> 
    {{-- my comment super great --}}
</form>
@endsection
