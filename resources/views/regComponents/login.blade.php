@extends('layouts.app')
@section('title-block')
    Регистрация
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-5">Log in</h2>
        <form action="{{route("logAccount")}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection
