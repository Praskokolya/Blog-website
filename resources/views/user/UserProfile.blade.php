<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')
    @section('profile')
        <div class="row py-5 px-4">
            <div class="col-md-7 mx-auto">
                <div class="bg-white shadow rounded overflow-hidden">
                    <div class="px-4 pt-0 pb-4 cover">
                        <div class="media align-items-end profile-head">
                            <div class="profile mr-3">
                                  <img src="{{ asset('storage/' . $data->userInfos[0]->image
                                 ) }}" width="130px" class="img-fluid rounded-circle">
                                <div class="media-body mb-5 text-black">
                                    <h4 class="mt-0 mb-0">{{ $data->nickname }}</h4>
                                    <div class="bg-light p-4 d-flex justify-content-end text-center">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <h5 class="font-weight-bold mb-0 d-block">{{ $amountOfPosts }}</h5>
                                                <small class="text-muted"> <i class="fas fa-image mr-1"></i>Posts</small>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="font-weight-bold mb-0 d-block">745</h5>
                                                <small class="text-muted"> <i class="fas fa-user mr-1"></i>Followers</small>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="font-weight-bold mb-0 d-block">340</h5>
                                                <small class="text-muted"> <i class="fas fa-user mr-1"></i>Following</small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="px-4 py-3">
                            <h5 class="mb-0">About</h5>
                            <div class="p-3 rounded shadow-sm bg-light">
                                @php
                                    if ($data->userInfos[0]->interests == null) {
                                        $data->userInfos[0]->interests = "Not Stated";
                                    }
                                @endphp
                                <p class="font-italic mb-0">{{ $data->userInfos[0]->interests }}</p>
                            </div>
                        </div>
                        <div class="py-4 px-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                
                                <h5 class="mb-0">Recent posts</h5><a href="#" class="btn btn-link text-muted"></a>
                            </div>
                            <div class="row mt-2">
                                @foreach ($posts as $post)
                                    @if (is_object($post))
                                        <div class="col-md-10">
                                            <div class="card border-danger mb-3" style="max-width: 1000px;">
                                                <div class="card-header">
                                                    @if ($data->userInfos[0]->image == null)
                                                        @php
                                                           $data->userInfos[0]->image = 'photos/without_picture.png';
                                                        @endphp
                                                    @endif
                                                    
                                                    <p class="card-text"><img src="{{ asset('storage/' . $data->userInfos[0]->image) }}"
                                                            alt="" class="img-fluid rounded-circle" id="avatarPost">
                                                        {{ $post->nickname }}</p>

                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                    <h6>{{ $post->subject }}</h6>
                                                    </p>
                                                    <p class="card-text">{{ $post->message }}</p>
                                                    <img src="{{ asset('storage/' . $post->post_image) }}" alt=""
                                                        id="postImage">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endsection
</body>

</html>
