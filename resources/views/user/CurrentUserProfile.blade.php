<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/profile.css">
</head>

<body>
    @extends('layouts.app')
    @section('profile')
        @foreach ($data as $item)
            <section class="pb-4">
                <div class="bg-white border rounded-5">
                    <section class="w-100 p-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <div class="avatar-container">
                                            <img src="{{ asset('storage/' . $item->image) }}" id="avatar" alt="avatar"
                                                class="img-fluid rounded-circle">
                                            <input type="file" name="image" id="file-input" class="hiddenInput">
                                            <img src="{{ asset('storage/photos/submit.svg') }}" alt="" class="bottom-image">
                                            <div class="delete-image">
                                                <img src="{{ asset('storage/photos/delete.png') }}" alt="" class="bottom-image-delete">
                                            </div>
                                        </div>
                                        <h5 class="my-3">{{ Auth::user()->nickname }}</h5>
                                        <div class="d-flex justify-content-center mb-2">
                                            <button type="button" class="btn btn-outline-primary ms-1" id="buttonDelete"
                                                onclick="showAllForms()">Change</button>
                                            <div class="hiddenbtn">
                                                <button type="submit" class="btn btn-outline-primary ms-1" id="buttonSave"
                                                    onclick="getData()">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="mb-0">Nickname</div>
                                            </div>
                                            <div class="col-sm-2">
                                                <form id="myForm" class="hiddenForm" id="new-name">
                                                    @csrf
                                                    <input type="text" name="new-name" id="new-name"
                                                        value={{ Auth::user()->nickname }}>
                                                </form>

                                                <div class="text-muted mb-0">
                                                    <div class="currentDataNickname">{{ Auth::user()->nickname }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Gender</p>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="text-muted mb-0">
                                                    <div class="currentDataGender">
                                                        {{ $item->gender }}
                                                    </div>
                                                </div>
                                                <div class="text-muted mb-0">
                                                    <form action="" id="myForm", name="gender" class="hiddenForm">
                                                        @csrf
                                                        <select name="gender" id="gender">
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="mehanic">Mechanic</option>
                                                        </select>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Interests</p>
                                            </div>
                                            <div class="col-sm-2">
                                                <form id="myForm" class="hiddenForm">
                                                    @csrf
                                                    <input type="text" name="interests", id="interests",
                                                        value="{{ old('interests', $item->interests) }}">
                                                </form>
                                                <div class="text-muted mb-0">
                                                    <div class="currentDataInterests">
                                                        {{ $item->interests }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Birthdate</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <form id="myForm" class="hiddenForm" name="Birthdate">
                                                    @csrf
                                                    <input type="date" name="birthdate"
                                                        value='{{ $item->birthdate }}', id="birthdate">
                                                </form>
                                                <div class="text-muted mb-0">
                                                    <div class="currentDataBirthdate">
                                                        {{ $item->birthdate }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </section>
                </div>
                </div>
            </section>
        @endforeach
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/currentUserProfile.js') }}"></script>
</body>

</html>
