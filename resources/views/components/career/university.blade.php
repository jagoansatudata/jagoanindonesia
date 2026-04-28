@php
    // Get universities directly in component to ensure data is available
    $universities = \App\Models\University::active()->ordered()->get();
@endphp

<section class="section career-university-section" aria-label="Kolaborasi universitas">
    <div class="container">
        <div class="career-univ-content">
            <div class="career-univ-copy">
                <h2 class="career-univ-title"><span class="univ-small">In Collaboration</span><br><span class="univ-large">with Universities</span></h2>
                <p class="career-univ-desc">Menghadirkan solusi inovatif dan berdampak bersama mitra pemerintah, pendidikan, komunitas, dan swasta.</p>
            </div>
            <div class="career-univ-logos" id="universitySliderContainer" role="list" aria-label="Logo universitas">
                @if($universities->count() > 0)
                    @foreach($universities as $university)
                        <div class="career-univ-logo" role="listitem" aria-label="{{ $university->name }} logo">
                            @if($university->website_url)
                                <a href="{{ $university->website_url }}" target="_blank" rel="noopener noreferrer">
                                    @if($university->logo_url)
                                        <img src="{{ $university->logo_url }}" alt="{{ $university->name }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-600 text-sm font-medium text-center p-2">
                                            {{ $university->name }}
                                        </div>
                                    @endif
                                </a>
                            @else
                                @if($university->logo_url)
                                    <img src="{{ $university->logo_url }}" alt="{{ $university->name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-600 text-sm font-medium text-center p-2">
                                        {{ $university->name }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-500 py-8">
                        <p class="text-sm">No universities available at the moment.</p>
                    </div>
                @endif
            </div>

            @if($universities->count() > 1)
                <div class="slide-indicators" id="universitySlideIndicators" aria-label="University logo slider indicators">
                    @foreach($universities as $university)
                        <button type="button" class="slide-indicator" aria-label="Go to {{ $university->name }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.career-univ-logos');
    const indicators = document.querySelectorAll('.slide-indicator');
    
    if (!container || indicators.length === 0) {
        return;
    }

    let currentIndex = 0;
    let isDragging = false;
    let startX = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    
    const isMobile = window.innerWidth <= 768;

    if (isMobile) {
        container.style.overflowX = 'auto';
        container.style.overflowY = 'hidden';
        container.style.whiteSpace = 'nowrap';
        container.style.transform = 'none';
        container.style.transition = 'none';
        return;
    }
    const logoWidth = isMobile ? 180 : 200; // Adjusted for mobile
    const totalLogos = container.children.length;
    const maxIndex = Math.max(0, totalLogos - 1);
    
    function updateSlider() {
        const scrollPosition = currentIndex * logoWidth;
        currentTranslate = -scrollPosition;
        container.style.transform = `translateX(${currentTranslate}px)`;
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentIndex);
        });
    }
    
    function snapToLogo() {
        const movedBy = currentTranslate - prevTranslate;
        if (movedBy < -50 && currentIndex < maxIndex) currentIndex += 1;
        if (movedBy > 50 && currentIndex > 0) currentIndex -= 1;
        updateSlider();
    }
    
    // Touch/Mouse events for mobile swipe
    function handleStart(e) {
        if (!isMobile) return;
        isDragging = true;
        startX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
        prevTranslate = currentTranslate;
        container.style.transition = 'none';
    }
    
    function handleMove(e) {
        if (!isDragging || !isMobile) return;
        e.preventDefault();
        const currentX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
        const diff = currentX - startX;
        currentTranslate = prevTranslate + diff;
        container.style.transform = `translateX(${currentTranslate}px)`;
    }
    
    function handleEnd() {
        if (!isDragging) return;
        isDragging = false;
        container.style.transition = 'transform 0.3s ease';
        snapToLogo();
    }
    
    // Indicator click events
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            currentIndex = index;
            updateSlider();
        });
    });
    
    // Touch/Mouse events
    container.addEventListener('touchstart', handleStart, { passive: true });
    container.addEventListener('touchmove', handleMove, { passive: false });
    container.addEventListener('touchend', handleEnd);
    container.addEventListener('mousedown', handleStart);
    container.addEventListener('mousemove', handleMove);
    container.addEventListener('mouseup', handleEnd);
    container.addEventListener('mouseleave', handleEnd);
    
    // Prevent text selection during drag
    container.addEventListener('selectstart', (e) => {
        if (isDragging) e.preventDefault();
    });
    
    // Handle window resize
    window.addEventListener('resize', () => {
        const newIsMobile = window.innerWidth <= 768;
        if (newIsMobile !== isMobile) {
            location.reload(); // Reload to apply proper mobile/desktop styles
        }
    });
    
    // Initialize
    updateSlider();
});
</script>
