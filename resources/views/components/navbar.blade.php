<nav class="navbar navbar-expand bg-white m-auto">
  <div class="container-fluid mx-4">
    <div class="navbar-nav justify-content-around" style="width: 100%">
      <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard"><img src="{{ asset('img/icon-home.svg') }}"></a>
      <a class="nav-link {{ Request::is('transaction/create') ? 'active' : '' }}" href="/transaction/create"><img src="{{ asset('img/icon-add.svg') }}"></a>
      <a class="nav-link {{ Request::is('transaction') ? 'active' : '' }}" href="/transaction"><img src="{{ asset('img/icon-history.svg') }}"></a>
      <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}" href="/user"><img src="{{ asset('img/icon-users.svg') }}"></a>
    </div>

  </div>
</nav>
