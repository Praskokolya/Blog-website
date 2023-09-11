@extends('layouts.app')

@section('title-block')
{{__('messages.about')}}
@endsection

@section('content')
<h1>{{__('messages.about')}}</h1>
<p><h3>{{__('messages.owner_site')}}</h3>
</p>
<h5>{{__('messages.what_to_do')}}</h5>
@endsection