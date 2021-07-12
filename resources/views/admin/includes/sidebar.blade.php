<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Mangol</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">MG</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        @if (Auth::user()->hasRole('admin'))
        <li class="nav-item {{ (request()->is('admin/dashboard') ? 'active' : '') }}"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
        <li class="menu-header">Menu Admin</li>
        <li class="nav-item {{ (request()->is('admin/genre*') ? 'active' : '') }}"><a class="nav-link" href="{{ route('genre.index') }}"><i class="far fa-clipboard"></i> <span>Genre</span></a></li>
        <li class="nav-item {{ (request()->is('admin/komik*') ? 'active' : '') }}"><a class="nav-link" href="{{ route('komik.index') }}"><i class="fas fa-book"></i> <span>Komik</span></a></li>
        <li class="nav-item {{ (request()->is('admin/user*') ? 'active' : '') }}"><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i> <span>User</span></a></li>
        @else
        <li class="nav-item {{ (request()->is('home') ? 'active' : '') }}"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-fire"></i><span>Home</span></a></li>
        <li class="menu-header">Menu</li>
        @endif
        <li class="nav-item {{ (request()->is('chapter*') ? 'active' : '') }}"><a href="{{ route('chapter.index') }}" class="nav-link"><i class="far fa-bookmark"></i><span>Chapter</span></a></li>
      </ul>
  </aside>
