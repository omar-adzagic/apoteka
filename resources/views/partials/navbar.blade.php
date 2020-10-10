<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <a class="navbar-item pocetna" href="/">Početna</a>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Ljekovi</a>
        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('medicines.index') }}">Svi Ljekovi</a>
          @if(!Auth::guest() && auth()->user()->role->name == 'Manager')
            <a class="navbar-item" href="{{ route('medicines.create') }}">Dodaj Lijek</a>
            <a class="navbar-item" href="{{ route('medicineTypes.index') }}">Tipovi Ljekova</a>
            <a class="navbar-item" href="{{ route('medicineTypes.create') }}">Dodaj Tip Lijeka</a>
          @endif
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Računi</a>
        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('receipts.index') }}">Svi Računi</a>
        </div>
      </div>
      @if(!Auth::guest() && auth()->user()->role->name == 'Manager')
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">Trebovanja</a>
          <div class="navbar-dropdown">
            <a class="navbar-item" href="{{ route('orders.index') }}">Sva Trebovanja</a>
          </div>
        </div>
      @endif
    </div>
    @if(!Auth::guest() && auth()->user()->role->name == 'Manager')
      <div class="navbar-end">
        <div class="navbar-item has-dropdown is-hoverable is-pulled-right">
          <a class="navbar-link">Korisnici</a>
          <div class="navbar-dropdown">
            <a class="navbar-item" href="{{ route('users.index') }}">Svi Korisnici</a>
            <a class="navbar-item" href="{{ route('users.create') }}">Dodaj Korisnika</a>
          </div>
        </div>
      </div>
    @endif
  </div>

  <div class="navbar-end">
    <div class="navbar-item">
      <div class="buttons">
        @auth
          <a class="button is-info" href="{{ route('logout') }}">Odjavi se {{ auth()->user()->ime }}</a>
        @endauth
        @guest
          <a class="button is-primary" href="{{ route('register') }}"><strong>Registracija</strong></a>
          <a class="button is-light" href="{{ route('login') }}">Prijava</a>
        @endguest
      </div>
    </div>
  </div>
</nav>
