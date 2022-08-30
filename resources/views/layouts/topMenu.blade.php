<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">AFFL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/admin/leagueConfig">League Config</a></li>
          </ul>
        </li>
      </ul>
      <button class="btn btn-outline-dark"data-bs-toggle="modal" data-bs-target="#loginModal" >
        <svg width="24" height="24" fill="#f8f9fa" class="bi bi-person-fill" viewBox="0 0 16 16">
          <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        </svg>
      </button>
    </div>
  </div>
</nav>

@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
  </div>
@endif

@if(session()->has('loginSuccessful'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    login sucessfull
  </div>
@endif

@if(session()->has('logoutSuccessful'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    logout sucessfull
  </div>
@endif

<div class="modal" id="loginModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="loginModalTitle" class="modal-title">
          @guest
            Log In
          @endguest
          @auth
            Hello {{Auth::user()->userName}}
          @endauth
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        @guest
          <form id="loginForm" action="/authenticate" method="POST">
            @csrf
            <div class="form-group">
              <label for="inputUserName">User Name</label>
              <input name='userName' type="text" class="form-control" id="inputUserName" placeholder="Enter User Name">
            </div>
            <br>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input name='password' type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <br>
            <button type="submit" id="loginSubmit" class="btn btn-primary">Submit</button>
          </form>
        @endguest
        @auth
          <form id="logoutForm" action="/logout" method="POST">
            @csrf
            <button type="submit" id="logoutSubmit" class="btn btn-danger">Log Out</button>
          </form>
        @endauth
      </div>
    </div>
  </div>
</div>

<script>
  setTimeout(closeAlert, 3000);

  function closeAlert() {
    $('.alert').hide();
  }
</script>