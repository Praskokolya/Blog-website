@extends('layouts.app')
@section('title-block')
    Регистрация
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-5">Вход</h2>
        <form action="route({{"logAccount"}})">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email адрес</label>
                <input type="email" class="form-control" id="email" placeholder="Введите email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" placeholder="Введите пароль">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection