@php
    $heroSections = $heroSections ?? collect([]);
@endphp
<section class="hero hero--home{{ $heroSections->count() <= 1 ? ' hero--single' : '' }}" id="heroSlider"
    @if($heroSections->isNotEmpty())
        style="--hero-bg-image: url('{{ ($heroSections->first()->background_image_url ?: asset('images/hero-background.png')) }}');"
    @else
        style="--hero-bg-image: url('{{ asset('images/hero-background.png') }}');"
    @endif
>
    <div id="beranda"></div>
    @if($heroSections && $heroSections->isNotEmpty())
        @if($heroSections->count() === 1)
            @php
                $heroSection = $heroSections->first();
            @endphp
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
        @elseif($heroSections->count() > 1)
            <!-- Slider Indicators -->
            <div class="hero-slider-indicators">
                @foreach($heroSections as $index => $heroSection)
                    <button type="button" class="hero-slider-indicator {{ $index == 0 ? 'active' : '' }}" 
                            onclick="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}">
                        <span class="sr-only">Slide {{ $index + 1 }}</span>
                    </button>
                @endforeach
            </div>

            <div class="hero-slider-progress" aria-hidden="true" style="display: none;">
                <div class="hero-slider-progress-bar" id="heroSliderProgressBar"></div>
            </div>
        @endif

        @if($heroSections->count() > 1)
            <!-- Slider Track -->
            <div class="hero-slider-track" id="heroSliderTrack">
                @foreach($heroSections as $heroSection)
                    <div class="hero-slide{{ $loop->first ? ' is-active' : '' }}"
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
        @endif
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

.hero--single .hero-slider-track {
    transform: none !important;
    transition: none !important;
}

.hero--single .hero-slide {
    opacity: 1 !important;
    transform: none !important;
    transition: none !important;
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

.hero-slider-progress {
    position: absolute;
    bottom: 1.25rem;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 3px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 999px;
    overflow: hidden;
    z-index: 10;
}

.hero-slider-progress-bar {
    width: 0%;
    height: 100%;
    background: #DB3D3E;
    border-radius: inherit;
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
    opacity: 0;
    transform: scale(0.985);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.hero-slide.is-active {
    opacity: 1;
    transform: scale(1);
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

    .hero-slider-progress {
        bottom: 0.75rem;
        width: 96px;
    }
    
    .hero-slider-indicator {
        width: 32px;
        height: 3px;
    }
}
</style>

@if(($heroSections ?? collect([]))->count() > 1)
<script>
let currentSlide = 0;
let slideInterval;
let progressRafId;
let progressStartTs;
const slideDurationMs = 5000;
let slideCount = 0;
const rawHeroSections = @json(($heroSections ?? collect([]))->values());
const heroSections = Array.isArray(rawHeroSections) ? rawHeroSections : Object.values(rawHeroSections ?? {});

function initHeroSlider() {
    slideCount = document.querySelectorAll('#heroSliderTrack .hero-slide').length;
    updateSlider();
    if (slideCount <= 1) return;
    
    // Auto-play slider
    startAutoSlide();
}

function slideHero(direction) {
    if (slideCount <= 1) return;
    
    const track = document.getElementById('heroSliderTrack');
    const indicators = document.querySelectorAll('.hero-slider-indicator');
    
    if (direction === 'next') {
        currentSlide = (currentSlide + 1) % slideCount;
    } else {
        currentSlide = (currentSlide - 1 + slideCount) % slideCount;
    }
    
    updateSlider();
}

function goToSlide(index) {
    if (slideCount <= 1) return;
    
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
    const progressBar = document.getElementById('heroSliderProgressBar');
    
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

    slides.forEach((slide, index) => {
        slide.classList.toggle('is-active', index === currentSlide);
    });

    if (progressBar) {
        progressBar.style.width = '0%';
    }
    
    // Update indicators
    indicators.forEach((indicator, index) => {
        indicator.classList.toggle('active', index === currentSlide);
    });
}

function startAutoSlide() {
    slideCount = document.querySelectorAll('#heroSliderTrack .hero-slide').length;

    if (slideCount <= 1) return;

    stopAutoSlide();

    const progressBar = document.getElementById('heroSliderProgressBar');
    progressStartTs = Date.now();

    slideInterval = setInterval(() => {
        const elapsed = Date.now() - progressStartTs;
        const progress = Math.min(1, elapsed / slideDurationMs);

        if (progressBar) {
            progressBar.style.width = `${progress * 100}%`;
        }

        if (progress >= 1) {
            slideHero('next');
            progressStartTs = Date.now();
        }
    }, 50);
}

function stopAutoSlide() {
    if (slideInterval) {
        clearInterval(slideInterval);
        slideInterval = undefined;
    }

    if (progressRafId) {
        cancelAnimationFrame(progressRafId);
        progressRafId = undefined;
    }
}

// Initialize slider when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroSlider);
} else {
    initHeroSlider();
}

window.addEventListener('load', initHeroSlider);

setTimeout(initHeroSlider, 0);

window.__heroSlider = {
    initHeroSlider,
    startAutoSlide,
    stopAutoSlide,
    get slideCount() { return slideCount; },
    get currentSlide() { return currentSlide; },
};
</script>
@endif
