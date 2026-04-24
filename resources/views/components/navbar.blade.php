<header id="site-header" class="site-header">
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="nav-brand" aria-label="Jagoan Indonesia - Beranda">
            <img
                src="{{ asset('images/logo-ji.svg') }}"
                alt=""
                class="nav-logo"
                width="154"
                height="62"
                decoding="async"
            />
        </a>
        <nav class="nav-menu" aria-label="Utama">
            <a href="{{ route('home') }}#top" class="nav-link">Beranda</a>
            <a href="{{ route('home') }}#tentang" class="nav-link">Tentang</a>
            <a href="{{ route('home') }}#portofolio" class="nav-link">Portofolio</a>
            <a href="{{ route('home') }}#blog" class="nav-link">Blog</a>
            <a href="{{ route('career') }}" class="nav-link">Karir</a>
            <a href="{{ route('home') }}#contact" class="btn btn-dark nav-cta mobile-cta">Hubungi Kami <img src="{{ asset('images/icon-arrow.svg') }}" alt="Arrow" class="nav-cta-arrow-icon"></a>
        </nav>
        <a href="{{ route('home') }}#contact" class="btn btn-dark nav-cta desktop-cta">Hubungi Kami <img src="{{ asset('images/icon-arrow.svg') }}" alt="Arrow" class="nav-cta-arrow-icon"></a>
        <button class="mobile-menu-toggle" aria-label="Toggle mobile menu" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<script>
function toggleMobileMenu() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    menuToggle.classList.toggle('active');
    navMenu.classList.toggle('active');
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navWrap = document.querySelector('.nav-wrap');
    
    if (menuToggle && navMenu && navWrap && !navWrap.contains(event.target)) {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
    }
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
    });
});
</script>
