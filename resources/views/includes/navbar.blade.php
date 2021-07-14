<header class="main-header" role="header" style="background-color:#070720;position:absolute;">
    <div class="container p-0">
      <div class="logo p-0">
        <a href="{{ route('mangol.home') }}"><em>Mangol</em></a>
      </div>
      <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
      <nav id="menu" class="main-nav" role="navigation">
        <ul class="main-menu p-0">
          <li><a href="{{ route('mangol.home') }}">Home</a></li>
          <li><a href="{{ route('mangol.genre') }}">Genre</a></li>
          <li><a href="{{ route('mangol.all.komik') }}">All Komik</a></li>
          <li>
          <form class="d-flex justify-content-center" action="{{ route('mangol.search') }}"  method="GET">
              @csrf
              <input class="animatebar" type="search" placeholder="Search" name="search" aria-label="Search">
              <button class="btn btn-warning bordl" type="submit">
              <i class="fas fa-search"></i>
              </button>
          </form>
          </li>
        </ul>
      </nav>
    </div>
</header>