
@include('layouts.default')

<body>

<div class="container mt-3">    
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Season</th>
        <th>Game</th>
        <th>Game Key</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($fantasyGames as $fantasyGame)
        <tr> 
          <td>{{ $fantasyGame->season }}</td>
          <td>{{ $fantasyGame->name }}</td>
          <td>{{ $fantasyGame->gameKey }}</td>
          <td>
            <button type="button" class="btn btn-outline-dark btn-sm editModalButton" data-bs-toggle="modal" 
              data-bs-target="#editModal{{ $fantasyGame->gameKey }}" data-id="{{ $fantasyGame->gameKey }}">
              <svg width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
              </svg>
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@foreach ($fantasyGames as $fantasyGame)
  <div class="modal" id="editModal{{ $fantasyGame->gameKey }}">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 id="editModalTitle" class="modal-title">{{ $fantasyGame->season }} {{ $fantasyGame->name }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          @foreach ($leagues as $league)
            @if ($league->gameKey == $fantasyGame->gameKey)
              <form action="/admin/deleteLeague" method="POST">
                @csrf
                <div class="row">
                  <input type="hidden" name="gameKey" value="{{ $league->gameKey }}">
                  <div class="col">
                    <input name='leagueNickname' type="text" class="form-control" value="{{ $league->nickname }}" readonly>
                  </div>
                  <div class="col">
                    <input name='leagueId' type="text" class="form-control" value="{{ $league->leagueId }}" readonly>
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" width="56" height="28" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                      </svg>
                    </button>  
                  </div>
                </div>
              </form>
              <br>
            @endif
          @endForeach

          <form action="/admin/createLeague" method="POST">
            @csrf
            <div class="row">
              <input type="hidden" name="gameKey" value="{{ $fantasyGame->gameKey }}">
              <div class="col">
                <input name='leagueNickname' type="text" class="form-control" placeholder="Nickname">
              </div>
              <div class="col">
                <input name='leagueId' type="text" class="form-control" placeholder="League ID">
              </div>
              <div class="col">
                <button type="submit" class="btn btn-outline-success btn-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="56" height="28" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach

</body>
</html>

