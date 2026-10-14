@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Jeep Wukirsari - Nikmati sensasi petualangan off-road terbaik di Wukirsari, Sleman, Yogyakarta. Pesan paket wisata jeep Anda sekarang!')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="hero" id="beranda">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="hero-badge">🚙 Wisata Off-Road Wukirsari</span>
        <h1 class="hero-title">
            Rasakan Petualangan <br>
            <span class="text-accent">Jeep Off-Road</span> Sejati
        </h1>
        <p class="hero-subtitle">
            Jelajahi medan terjal Wukirsari dengan armada jeep tangguh kami.
            Pemandangan memukau, adrenalin terjaga, kenangan tak terlupakan.
        </p>
        <div class="hero-actions">
            <a href="#paket" class="btn btn-primary btn-lg" id="hero-btn-paket">
                Lihat Paket Wisata
            </a>
            <a href="#tentang" class="btn btn-outline btn-lg" id="hero-btn-tentang">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
    <div class="hero-scroll-indicator">
        <span>Scroll ke bawah</span>
        <div class="scroll-arrow"></div>
    </div>
</section>

{{-- ===== STATUS CHECK — Hanya tampil di mode DEBUG ===== --}}
@if(config('app.debug'))
<section class="debug-banner">
    <div class="container">
        <p>
            ✅ <strong>Laravel {{ app()->version() }}</strong> berjalan dengan baik.
            &nbsp;|&nbsp; PHP {{ PHP_VERSION }}
            &nbsp;|&nbsp; Environment: <code>{{ config('app.env') }}</code>
        </p>
    </div>
</section>
@endif

{{-- ===== FITUR UNGGULAN ===== --}}
<section class="features" id="fitur">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Mengapa Memilih Jeep Wukirsari?</h2>
            <p class="section-subtitle">Kami hadir untuk memberikan pengalaman wisata off-road terbaik dan paling aman</p>
        </div>
        <div class="features-grid">
            <div class="feature-card" id="feature-aman">
                <div class="feature-icon">🛡️</div>
                <h3>Aman & Terpercaya</h3>
                <p>Driver berpengalaman dan armada jeep terawat untuk keselamatan perjalanan Anda.</p>
            </div>
            <div class="feature-card" id="feature-pemandangan">
                <div class="feature-icon">🏔️</div>
                <h3>Pemandangan Indah</h3>
                <p>Nikmati panorama alam Wukirsari yang memukau sepanjang perjalanan off-road.</p>
            </div>
            <div class="feature-card" id="feature-fleksibel">
                <div class="feature-icon">📅</div>
                <h3>Paket Fleksibel</h3>
                <p>Berbagai pilihan paket wisata yang bisa disesuaikan dengan kebutuhan dan budget Anda.</p>
            </div>
            <div class="feature-card" id="feature-guide">
                <div class="feature-icon">🗺️</div>
                <h3>Guide Lokal</h3>
                <p>Dipandu oleh warga lokal yang fasih bercerita tentang sejarah dan budaya Wukirsari.</p>
            </div>
        </div>
    </div>
</section>

@endsection
