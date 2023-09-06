<form action="{{ route('getPost') }}" method="post">
    @csrf
    <div class="form-group mt-5">
        <input class="form-control" type="text" placeholder="Name of post" name="namePost"> 
    </div>
    <button type="submit" class="btn btn-primary">Search</button> 
</form>
