
@include('layouts.default')

<body>

<div class="container mt-3">    
  <h3>User Management</h3>
  <br>

  @foreach ($users as $user)  
    <form method="POST">
      @csrf
      <div class="row">
        <div class="col">
          <input name='userId' type="text" class="form-control" value="{{ $user->id }}" readonly>
        </div>
        <div class="col">
          <input name='userName' type="text" class="form-control" value="{{ $user->userName }}" readonly>
        </div>
        <div class="col">
          <input name='newPassword' type="password" class="form-control" placeholder="New Password">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-outline-warning btn-sm" formaction="/admin/editUser">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="28" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
              <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
          </button>
        </div>  
        <div class="col">    
          <button type="submit" class="btn btn-outline-danger btn-sm" formaction="/admin/deleteUser">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="28" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
            </svg>
          </button>  
        </div>
      </div>
      <br>
    </form>
  @endforeach

  <form action="/admin/addUser" method="POST">
    @csrf
    <div class="row">
      <div class="col">
      </div>
      <div class="col">
        <input name='userName' type="text" class="form-control" placeholder="Username">
      </div>
      <div class="col">
        <input name='password' type="password" class="form-control" placeholder="Password">
      </div>
      <div class="col">    
        <button type="submit" class="btn btn-outline-success btn-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="56" height="28" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>
        </button>  
      </div>  
      <div class="col">
      </div>
    </div>
  </form>
</div>

</body>
</html>

