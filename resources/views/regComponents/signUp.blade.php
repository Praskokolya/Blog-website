@extends('layouts.app')

@section('content')
<body>
    <div class="container mt-5">
        <h1 class="text-center">Начать</h1>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form>
                    <div class="form-group">
                        <a href="{{route("login")}}"><button type="button" class="btn btn-primary btn-block">Login</button></a>
                    </div>
                    <div class="form-group">
                        <a href="{{route("regForm")}}"><button type="button" class="btn btn-secondary btn-block">Register</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Подключаем скрипты Bootstrap JS (jQuery и Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

@endsection
