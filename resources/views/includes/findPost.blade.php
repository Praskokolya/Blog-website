<form action="{{ route('getPost') }}" method="post">
    @csrf
    <div class="form-group mt-5">
        <input class="form-control" type="text" placeholder="Название поста" name="namePost"> 
    </div>
    <button type="submit" class="btn btn-primary">Найти</button> 
</form>
