
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
            data-bs-target="#editModal" data-id="{{ $fantasyGame->gameKey }}">
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

<!-- The Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 id="editModalTitle" class="modal-title"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>ID</th>
          </tr>
        </thead>
        <tbody id="leaguesTable">
          
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>

<script>
  $('.editModalButton').click(function () {  
    var gameKey = $(this).data('id');
    $('#editModalTitle').text('Leagues for ' + gameKey);
    $('#leaguesTable').empty();
    var leagues = {{ Js::from($leagues) }};
    leagues.forEach(element => console.log(element));

    leagues.forEach((league) => {
      if (league.gameKey == gameKey) {
        console.log(league.leagueId);
        $('#leaguesTable').append(
          `<tr> 
            <td>` + league.nickname + `</td>
            <td><input size="5" value=` + league.leagueId + `></td>
            <td>
              <button type="button" class="btn btn-outline-warning btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
              </button>
              <button type="button" class="btn btn-outline-danger btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                </svg>
              </button>
            </td>
          </tr>`
        );
      }
    });

    $('#leaguesTable').append(
      `<tr> 
        <td><input size="15"></td>
        <td><input size="5"></td>
        <td>
          <button type="button" class="btn btn-outline-success btn-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>
          </button>
        </td>
      </tr>`
    );
  });  
</script>

</body>
</html>

