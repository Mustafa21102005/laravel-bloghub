<ul class="navbar-nav ms-auto py-4 py-lg-0">
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('posts.create') }}">Create Post</a>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link px-lg-3 py-3 py-lg-4 dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('bookmarks.index') }}">My Bookmarks</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
