@extends('layouts.app')

@section('title-block')
{{__('messages.about')}}
@endsection

@section('content')
<h1>{{__('messages.about')}}</h1>
<p><h3>{{__('messages.owner_site')}}</h3>
</p>
<p>{{__('messages.our_website')}}</p>
@endsection