<nav>
    <div class="brand">📚 Perpustakaan Digital Kampus</div>
    @auth
        <ul>
            <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">Buku</a></li>
            @if (auth()->user()->role === 'admin')
                <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Kategori</a></li>
            @endif
            <li><a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">Anggota</a></li>
            <li><a href="{{ route('loans.index') }}" class="{{ request()->routeIs('loans.*') ? 'active' : '' }}">Peminjaman</a></li>
        </ul>
        <ul>
            <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">Buku</a></li>
            @if (auth()->user()->role === 'admin')
                <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Kategori</a></li>
            @endif
            <li><a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">Anggota</a></li>
            <li><a href="{{ route('loans.index') }}" class="{{ request()->routeIs('loans.*') ? 'active' : '' }}">Peminjaman</a></li>
            <!-- Tambahan Link Profil -->
            <li><a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">Profil</a></li>
        </ul>
        <div class="navbar-user">
            <span>{{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    @endauth
    @guest
        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
    @endguest
</nav>