<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="navbar-brand" id="navbar-logo">
            <span class="brand-icon">🚙</span>
            <span class="brand-text">Jeep <strong>Wukirsari</strong></span>
        </a>

        <ul class="navbar-menu" id="navbar-menu">
            <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="#paket" class="nav-link">Paket Wisata</a></li>
            <li><a href="#tentang" class="nav-link">Tentang Kami</a></li>
            <li><a href="#kontak" class="nav-link">Kontak</a></li>
        </ul>

        <div class="navbar-actions">
            <a href="#pesan" class="btn btn-primary" id="btn-pesan">Pesan Sekarang</a>
        </div>

        <button class="navbar-toggle" id="navbar-toggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
