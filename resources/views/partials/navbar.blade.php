<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <a class="navbar-item pocetna" href="/">Homepage</a>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Medicines</a>
        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('medicines.index') }}">All medicines</a>
          @if(!Auth::guest() && auth()->user()->role->name == 'Manager')
            <a class="navbar-item" href="{{ route('medicines.create') }}">Add medicine</a>
            <a class="navbar-item" href="{{ route('medicineTypes.index') }}">Medicine types</a>
            <a class="navbar-item" href="{{ route('medicineTypes.create') }}">Add medicine type</a>
          @endif
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">Računi</a>
        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('receipts.index') }}">All receipts</a>
        </div>
      </div>
      @if(!Auth::guest() && auth()->user()->role->name == 'Manager')
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">Trebovanja</a>
          <div class="navbar-dropdown">
            <a class="navbar-item" href="{{ route('orders.index') }}">All orders</a>
          </div>
        </div>
      @endif
    </div>
    @if(!Auth::guest() && auth()->user()->role->name == 'Manager')
      <div class="navbar-end">
        <div class="navbar-item has-dropdown is-hoverable is-pulled-right">
          <a class="navbar-link">Users</a>
          <div class="navbar-dropdown">
            <a class="navbar-item" href="{{ route('users.index') }}">All users</a>
            <a class="navbar-item" href="{{ route('users.create') }}">Add user</a>
          </div>
        </div>
      </div>
    @endif
  </div>

  <div class="navbar-end">
    <div class="navbar-item">
      <div class="buttons">
        @auth
          <a class="button is-info" href="{{ route('logout') }}">Logout {{ auth()->user()->name }}</a>
        @endauth
        @guest
          <a class="button is-primary" href="{{ route('register') }}"><strong>Registration</strong></a>
          <a class="button is-light" href="{{ route('login') }}">Login</a>
        @endguest
      </div>
    </div>
  </div>
</nav>
