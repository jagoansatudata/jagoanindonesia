<section id="testimoni" class="section section-alt" aria-label="Intern experiences">
    <div class="container">
        <div class="career-stories">
            <div class="career-stories-grid">
                <div class="career-stories-copy">
                    <h2 class="career-stories-title"><span class="small">Intern</span><span class="small">Experiences &amp;</span><span class="large">Growth Stories</span></h2>
                    <div class="career-stories-actions" aria-label="Navigasi cerita" aria-hidden="true">
                        <button type="button" class="career-stories-nav career-stories-nav--prev">&lt;</button>
                        <button type="button" class="career-stories-nav career-stories-nav--next">&gt;</button>
                    </div>
                </div>
                <div class="career-stories-wrapper">
                    <div class="career-stories-cards" role="list">
                        @forelse(($internExperiences ?? collect()) as $experience)
                            <article class="career-story-card" role="listitem">
                                <div class="career-story-stars" aria-hidden="true">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="career-story-star">{{ $i <= ($experience->rating ?? 5) ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                                <p class="career-story-text">{{ $experience->experience_content }}</p>
                                <div class="career-story-divider"></div>
                                <div class="career-story-author">
                                    <div class="career-story-avatar" aria-hidden="true">
                                        @if($experience->avatar_path)
                                            <img src="{{ asset('storage/' . $experience->avatar_path) }}" alt="{{ $experience->intern_name }}" />
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="career-story-name">{{ $experience->intern_name }}</h3>
                                        @if($experience->intern_role)
                                            <p class="career-story-role">{{ $experience->intern_role }}</p>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="text-center py-12">
                                <p class="text-gray-500">Belum ada cerita internship yang ditampilkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <h2 class="career-journey-title"><span class="journey-small">Start Your Journey with</span><span class="journey-large">Jagoan Indonesia</span></h2>

        <div class="career-stats" role="list" aria-label="Statistik karir">
            @forelse(($careerStats ?? collect()) as $stat)
                <article class="career-stat" role="listitem">
                    <div class="career-stat-icon" aria-hidden="true">
                        @if($stat->icon_path)
                            <img src="{{ asset($stat->icon_path) }}" alt="{{ $stat->title }}" width="85" height="59" />
                        @else
                            <svg width="85" height="59" viewBox="0 0 85 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="85" height="59" rx="8" fill="#F3F4F6"/>
                                <path d="M35 19V39M25 29H45" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        @endif
                    </div>
                    <h3 class="career-stat-value">{{ $stat->value }}</h3>
                    <p class="career-stat-label">{{ $stat->description }}</p>
                </article>
            @empty
                <article class="career-stat" role="listitem">
                    <div class="career-stat-icon" aria-hidden="true">
                        <svg width="85" height="59" viewBox="0 0 85 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="85" height="59" rx="8" fill="#F3F4F6"/>
                            <path d="M35 19V39M25 29H45" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="career-stat-value">No Data</h3>
                    <p class="career-stat-label">Career statistics will be displayed here once configured.</p>
                </article>
            @endforelse
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.querySelector('.career-stories-wrapper');
    const cards = document.querySelector('.career-stories-cards');
    const prevBtn = document.querySelector('.career-stories-nav--prev');
    const nextBtn = document.querySelector('.career-stories-nav--next');
    
    if (!wrapper || !cards || !prevBtn || !nextBtn) {
        return;
    }

    let currentIndex = 0;
    const cardWidth = 320; // card width + gap
    const maxScroll = cards.scrollWidth - wrapper.clientWidth;
    const totalCards = cards.children.length;
    const maxIndex = Math.max(0, totalCards - 2);
    
    function updateSlider() {
        const scrollPosition = currentIndex * cardWidth;
        cards.style.transform = `translateX(-${scrollPosition}px)`;
        
        // Update button states
        prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
        prevBtn.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
        
        nextBtn.style.opacity = scrollPosition >= maxScroll ? '0.5' : '1';
        nextBtn.style.cursor = scrollPosition >= maxScroll ? 'not-allowed' : 'pointer';
    }
    
    prevBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });
    
    nextBtn.addEventListener('click', function() {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateSlider();
        }
    });
    
    // Initialize
    updateSlider();
});
</script>
