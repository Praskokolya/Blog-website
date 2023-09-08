<form action="{{ route('getPost') }}" method="post">
    @csrf
    <div class="form-group mt-5">
        <input class="form-control" type="text" placeholder="{{__('messages.name_of_post')}}" name="namePost"> 
    </div>
    <button type="submit" class="btn btn-primary">{{__('messages.search')}}</button> 
</form>
