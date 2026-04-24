<header id="site-header" class="site-header">
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="nav-brand" aria-label="Jagoan Indonesia — Beranda">
            <img
                src="{{ asset('images/logo-ji.svg') }}"
                alt=""
                class="nav-logo"
                width="154"
                height="62"
                decoding="async"
            />
        </a>
        <nav class="nav-menu" aria-label="Karir Menu">
            <a href="{{ route('home') }}" class="nav-link">Beranda</a>
            <a href="{{ route('career') }}#benefit" class="nav-link">Benefit</a>
            <a href="{{ route('career') }}#testimoni" class="nav-link">Testimoni</a>
            <a href="{{ route('career') }}#kualifikasi" class="nav-link">Kualifikasi</a>
            <a href="{{ route('career') }}#faq" class="nav-link">FAQ</a>
        </nav>
        <a href="#" class="btn btn-dark nav-cta">Hubungi Kami <img src="/images/icon-arrow.svg" alt="" class="nav-cta-arrow-icon" width="33" height="27"></a>
    </div>
</header>
