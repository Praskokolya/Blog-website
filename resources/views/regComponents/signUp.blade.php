<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="/css/signUp.css">

</head>
<body>
    <div class="regContainer">
        <div class="container mt-5">
            <h1 class="title is-1 has-text-centered">Let's start!</h1>
            <div class="columns is-centered">
                <div class="field is-grouped">
                    <form>
                        <div class="field">
                        <a href="{{route("regForm")}}" class="button is-info is-rounded is-medium is-fullwidth">Register</a>
                        </div>
                        <div class="field">
                            <a href="{{route("login")}}" class="button is-warning is-rounded is-medium is-fullwidth" id="loginBtn">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
