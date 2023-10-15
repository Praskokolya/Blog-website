<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route("responseCreate")}}" method="get" target="_self">
        <input type="text" class="form-control" name="data" placeholder="Enter reponse">
        <input type="hidden" name="post_id" value="{{ $postId }}">
        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
</body>
</html>