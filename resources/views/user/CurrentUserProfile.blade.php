<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @include('includes.header')
    <section class="pb-4">
        <div class="bg-white border rounded-5">    
          <section class="w-100 p-4" style="background-color: #eee; border-radius: .5rem .5rem 0 0;">      
            <div class="row">
              <div class="col-lg-4">
                <div class="card mb-4">
                  <div class="card-body text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/6596/6596121.png" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3">John Smith</h5>
                    <p class="text-muted mb-1">Full Stack Developer</p>
                    <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                    <div class="d-flex justify-content-center mb-2">
                      <button type="button" class="btn btn-outline-primary ms-1" id="buttonDelete"onclick="showAllForms()">Change</button>
                      <div class="hiddenbtn"><button type="submit" class="btn btn-outline-primary ms-1" id="buttonSave" onclick="sendData()">Save</button></div>
                    </div>
                  </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                  <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fas fa-globe fa-lg text-warning"></i>
                        <p class="mb-0">https://mdbootstrap.com</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                        <p class="mb-0">mdbootstrap</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                        <p class="mb-0">@mdbootstrap</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                        <p class="mb-0">mdbootstrap</p>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                        <p class="mb-0">mdbootstrap</p>
                      </li>
                    </ul>
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
                        <form id="myForm" class="">
                          <input type="text" name="new-name" value={{Auth::user()->nickname}}>
                        </form>
                        <div class="text-muted mb-0"><div class="currentDataNickname">{{Auth::user()->nickname}}</div></div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                      </div>
                      <div class="col-sm-3">
                        <p class="text-muted mb-0">{{Auth::user()->email}}</p>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Gender</p>
                      </div>
                      <div class="col-sm-2">
                        <div class="text-muted mb-0"><div class="currentDataGender">Not stated</div></div>
                        <div class="text-muted mb-0">
                        <form action="" id="myForm", name="gender">
                          <select name="gender" id="gender">
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                              <option value="other">Mechanic</option>
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
                        <form id="myForm" class="">
                          <input type="text" name="Interests" value=''>
                        </form>
                        <div class="text-muted mb-0"><div class="currentDataInterests">Nothing</div></div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <p class="mb-0">Birthdate</p>
                      </div>
                      <div class="col-sm-3">
                        <form id="myForm" class="">
                          <input type="text" name="Birthdate" value=''>
                        </form>
                        <div class="text-muted mb-0"><div class="currentDataBirthdate">Unspecified</div></div>
                      </div>
                    </div>
                  </div>
                </div>
          </section>
          </div>                   
        </div>
      </section>
      
      <script src="{{ asset('js/currentUserProfile.js') }}"></script>

</body>
</html>