@extends('layouts.app')


@section('content')
    <div class="container">
        <h2 class="mt-5">Регистрация</h2>
        <form action="{{ route('registerAccount') }}" method="GET">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя</label>
                <input type="text" class="form-control" name="nickname" id="username" placeholder="Введите имя пользователя">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email адрес</label>
                <input type="email" class="form-control"  name="email" id="email" placeholder="Введите email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Подтвердите пароль</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Подтвердите пароль" required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>

    <!-- Подключение скриптов Bootstrap и jQuery (необходимо для работы некоторых компонентов Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection