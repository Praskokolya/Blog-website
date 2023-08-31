@extends('layouts.app')

@section('title-block')Главная страница@endsection

@section('content')
<h1>Главная страница</h1>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
    Cumque alias, est iste ut,
    ducimus a velit modi ullam voluptates consequatur qui dolore ea
    sapiente earum quisquam nemo et totam doloribus!
</p>
@endsection
@section('aside')
    @parent
    <p>Дополнительный текст</p>
@endsection