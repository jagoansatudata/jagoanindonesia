@php
    $heroSections = $heroSections ?? collect([]);
@endphp
<section class="hero hero--home" id="heroSlider"
    @if($heroSections->isNotEmpty())
        style="--hero-bg-image: url('{{ ($heroSections->first()->background_image_url ?: asset('images/hero-background.png')) }}');"
    @else
        style="--hero-bg-image: url('{{ asset('images/hero-background.png') }}');"
    @endif
>
    <div id="beranda"></div>
    @if($heroSections && $heroSections->isNotEmpty())
        @if($heroSections->count() > 1)
            <!-- Slider Navigation -->
            <div class="hero-slider-nav">
                <button type="button" class="hero-slider-btn hero-slider-btn--prev" onclick="slideHero('prev')" aria-label="Previous slide">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button type="button" class="hero-slider-btn hero-slider-btn--next" onclick="slideHero('next')" aria-label="Next slide">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        @endif

        @if($heroSections->count() > 1)
            <!-- Slider Indicators -->
            <div class="hero-slider-indicators">
                @foreach($heroSections as $index => $heroSection)
                    <button type="button" class="hero-slider-indicator {{ $index == 0 ? 'active' : '' }}" 
                            onclick="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}">
                        <span class="sr-only">Slide {{ $index + 1 }}</span>
                    </button>
                @endforeach
            </div>
        @endif

        <!-- Slider Track -->
        <div class="hero-slider-track" id="heroSliderTrack">
            @foreach($heroSections as $heroSection)
                <div class="hero-slide"
                     data-hero-bg="{{ $heroSection->background_image_url ?: asset('images/hero-background.png') }}">
                    <div class="container hero-inner">
                        <div class="hero-grid">
                            <div class="hero-copy">
                                <h1 class="hero-title">
                                    {!! $heroSection->title !!}
                                </h1>
                                <p class="hero-lead">
                                    {{ $heroSection->subtitle }}
                                </p>
                                <a href="{{ $heroSection->button_url }}" class="btn btn-hero-light">
                                    {{ $heroSection->button_text }}
                                    <img src="{{ asset('images/icon-arrow-black.svg') }}" alt="Arrow" class="btn-arrow-icon">
                                </a>
                            </div>
                            <div class="hero-image">
                                <!-- Image or content for the right side can go here -->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Fallback hero section if no hero sections exist -->
        <div class="hero-slide" data-hero-bg="{{ asset('images/hero-background.png') }}">
            <div class="container hero-inner">
                <div class="hero-grid">
                    <div class="hero-copy">
                        <h1 class="hero-title">
                            Strategi Terarah<br>Dampak <span class="hero-title-accent">Nyata</span>
                        </h1>
                        <p class="hero-lead">
                            Solusi strategis untuk bisnis dan instansi yang ingin tumbuh secara terarah dan berkelanjutan.
                        </p>
                        <a href="{{ route('home') }}#tentang" class="btn btn-hero-light">
                            Mulai Sekarang
                            <img src="{{ asset('images/icon-arrow-black.svg') }}" alt="Arrow" class="btn-arrow-icon">
                        </a>
                    </div>
                    <div class="hero-image">
                        <!-- Image or content for the right side can go here -->
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>

<style>
.hero {
    overflow: hidden;
}

.hero-slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 2rem;
    pointer-events: none;
    z-index: 30;
}

.hero-slider-btn {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: #272525;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    pointer-events: all;
    backdrop-filter: blur(10px);
}

.hero-slider-btn:hover {
    background: rgba(255, 255, 255, 1);
    border-color: #DB3D3E;
    transform: scale(1.1);
}

.hero-slider-indicators {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.75rem;
    z-index: 10;
}

.hero-slider-indicator {
    width: 40px;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    border-radius: 2px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.hero-slider-indicator::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: #DB3D3E;
    transition: width 0.3s ease;
}

.hero-slider-indicator.active::before,
.hero-slider-indicator:hover::before {
    width: 100%;
}

.hero-slider-track {
    display: flex;
    transition: transform 0.5s ease;
}

.hero-slide {
    min-width: 100%;
    position: relative;
}

@media (max-width: 768px) {
    .hero-slider-nav {
        display: none !important;
        padding: 0 1rem;
    }
    
    .hero-slider-btn {
        width: 40px;
        height: 40px;
    }
    
    .hero-slider-indicators {
        bottom: 1rem;
        gap: 0.5rem;
    }
    
    .hero-slider-indicator {
        width: 32px;
        height: 3px;
    }
}
</style>

<script>
let currentSlide = 0;
let slideInterval;
const heroSections = @json($heroSections ?? []);

function initHeroSlider() {
    updateSlider();
    if (heroSections.length <= 1) return;
    
    // Auto-play slider
    startAutoSlide();
    
    // Pause on hover
    const slider = document.getElementById('heroSlider');
    slider.addEventListener('mouseenter', stopAutoSlide);
    slider.addEventListener('mouseleave', startAutoSlide);
}

function slideHero(direction) {
    if (heroSections.length <= 1) return;
    
    const track = document.getElementById('heroSliderTrack');
    const indicators = document.querySelectorAll('.hero-slider-indicator');
    
    if (direction === 'next') {
        currentSlide = (currentSlide + 1) % heroSections.length;
    } else {
        currentSlide = (currentSlide - 1 + heroSections.length) % heroSections.length;
    }
    
    updateSlider();
}

function goToSlide(index) {
    if (heroSections.length <= 1) return;
    
    currentSlide = index;
    updateSlider();
    stopAutoSlide();
    startAutoSlide();
}

function updateSlider() {
    const track = document.getElementById('heroSliderTrack');
    const indicators = document.querySelectorAll('.hero-slider-indicator');
    const slider = document.getElementById('heroSlider');
    const slides = document.querySelectorAll('.hero-slide');
    
    // Update slide position
    track.style.transform = `translateX(-${currentSlide * 100}%)`;

    // Update hero background image on the container (.hero)
    const activeSlide = slides[currentSlide];
    if (slider && activeSlide) {
        const bg = activeSlide.getAttribute('data-hero-bg');
        if (bg) {
            slider.style.setProperty('--hero-bg-image', `url('${bg}')`);
        }
    }
    
    // Update indicators
    indicators.forEach((indicator, index) => {
        indicator.classList.toggle('active', index === currentSlide);
    });
}

function startAutoSlide() {
    if (heroSections.length <= 1) return;
    
    slideInterval = setInterval(() => {
        slideHero('next');
    }, 5000);
}

function stopAutoSlide() {
    if (slideInterval) {
        clearInterval(slideInterval);
    }
}

// Initialize slider when DOM is ready
document.addEventListener('DOMContentLoaded', initHeroSlider);
</script>
