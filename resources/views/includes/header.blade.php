<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
  <a href="{{ route('home') }}" class="my-0 mr-md-auto font-weight-normal" id='Corp'><h5>Corpotation</h5></a>
  <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="{{ route('home') }}">Main</a>
      <a class="p-2 text-dark" href="{{ route('contact') }}">Add message</a>
      <a class="p-2 text-dark" href="{{ route('about') }}">About us</a>
      <a class="p-2 text-dark" href="{{ route('contactData') }}">Messages</a>
  </nav>
  @if (Auth::check())
  <a class="p-2 text-dark" href="{{ route('logoutAccount') }}">Logout</a>    
  <div><h6>{{ Auth::user()->nickname }}</h6></div>
  @else
      <a class="btn btn-outline-primary" href="{{ route("authForm") }}">Sign up</a>
  @endif
</div>
