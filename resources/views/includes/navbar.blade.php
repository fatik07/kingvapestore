<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
  <div class="container">
    <a href="{{ route('home') }}" class="navbar-brand">
      <img src="{{ asset('images/logokwu.png') }}" style="width:70%" alt="logo" />
    </a>
    <div class="navbar-brand" style="font-weight: 700; font-size:26px; margin-left:-20px">
      KingVape
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('categories') }}" class="nav-link">Categories</a>
        </li>
        {{-- <li class="nav-item">
          <a href="/reward.html" class="nav-link">Reward</a>
        </li> --}}

        {{-- jika belum login --}}
        @guest
        <li class="nav-item">
          <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('login') }}" class="btn btn-success px-4 text-white nav-link">Sign In</a>
        </li>
        @endguest

      </ul>

      {{-- jika sudah login --}}
      @auth
      <!-- Dekstop Menu -->
      <ul class="navbar-nav d-none d-lg-flex ml-auto">
        <li class="nav-item dropdown">
          <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
            <img src="/images/image 13.png" alt="face" class="rounded-circle mr-2 profile-picture">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu">
            {{-- <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a> --}}
            <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">Setting</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ route('cart') }}" class="nav-link d-blok mt-2">
            {{-- inisialisasi cart agar bisa mnegambil datanya --}}
            @php
            $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
            @endphp

            @if ($carts > 0)
            <img src="/images/shopping 1.svg" alt="icon cart">
            <div class="card-badge">{{ $carts }}</div>
            @else
            <img src="/images/shopping 1.svg" alt="icon cart">
            @endif

          </a>
        </li>
      </ul>

      <!-- Mobile Menu -->
      <div class="navbar-nav d-blok d-lg-none">
        <li class="nav-item">
          <a href="#" class="nav-link">{{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item d-inline-block">
          <a href="{{ route('cart') }}" class="nav-link">Cart</a>
        </li>
      </div>
      @endauth
    </div>
  </div>
</nav>