@extends('layouts.app')


@section('content')
    <div class="container">
        <h2 class="mt-5">Registration</h2>
        <form action="{{ route('registerAccount') }}" method="GET">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="nickname" id="username" placeholder="Enter username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control"  name="email" id="email" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm password</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" required>
            </div>
            <button type="submit" class="btn btn-primary">Check in</button>
        </form>
    </div>

    <!-- Подключение скриптов Bootstrap и jQuery (необходимо для работы некоторых компонентов Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection