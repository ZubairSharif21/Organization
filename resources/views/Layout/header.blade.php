<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home">WebProduct</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Data
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @if (session('email'))
                <li><a class="dropdown-item" href="{{ url('user_data') }}">Show Users</a></li>

          @endif
          <li><a class="dropdown-item" href="#">Action</a></li>
        </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" tabindex="-1" >Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">Create Vendor</a>
          </li>     </ul>
        @if (session('email'))
    <p class="m-2">{{session('email')  }}</p>
   <a href="user_logout"> <button class="btn btn-danger">Logout</button></a>
   @else
   <a href="{{ url('/') }}"> <button class="btn btn-info mx-3">Login</button></a>
   <a href="{{ url('signup') }}"> <button class="btn btn-success">Signup</button></a>

@endif

      </div>
    </div>
  </nav>
