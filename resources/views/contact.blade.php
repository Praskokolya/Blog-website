@extends('layouts.app')

@section('title-block')
    @lang('messages.contact_page')
@endsection

@section('content')
<h1>@lang('messages.contact_page')</h1>

<form action="{{ route('contact-form') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="subject">@lang('messages.post_subject')</label>
        <input type="text" name="subject" placeholder="@lang('messages.post_subject')" id="subject" class="form-control">
    </div>
    <div class="form-group">
        <label for="message">@lang('messages.message')</label>
        <textarea name="message" id="message" cols="10" rows="10" class="form-control" placeholder="@lang('messages.enter_message')"></textarea>
    </div>
    <button type="submit" class="btn btn-success">@lang('messages.send')</button>
</form>
@endsection
