import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const header = document.getElementById('site-header');

if (header) {
    const scrolledClass = 'site-header--scrolled';
    const scrollOffset = 24;

    const updateHeader = () => {
        const isScrolled = window.scrollY > scrollOffset;
        header.classList.toggle(scrolledClass, isScrolled);
    };

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });
}

// Team Slider Functionality
const teamSliderContainer = document.getElementById('teamSliderContainer');
const slideIndicators = document.getElementById('slideIndicators');

if (teamSliderContainer && slideIndicators) {
    const indicators = slideIndicators.querySelectorAll('.slide-indicator');
    const cards = teamSliderContainer.querySelectorAll('.mobile-card');
    
    // Update active indicator based on scroll position
    const updateActiveIndicator = () => {
        const containerRect = teamSliderContainer.getBoundingClientRect();
        const containerCenter = containerRect.left + containerRect.width / 2;
        
        let activeIndex = 0;
        let minDistance = Infinity;
        
        cards.forEach((card, index) => {
            const cardRect = card.getBoundingClientRect();
            const cardCenter = cardRect.left + cardRect.width / 2;
            const distance = Math.abs(containerCenter - cardCenter);
            
            if (distance < minDistance) {
                minDistance = distance;
                activeIndex = index;
            }
        });
        
        // Update indicator states
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === activeIndex);
        });
    };
    
    // Handle indicator clicks
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            const targetCard = cards[index];
            if (targetCard) {
                const cardRect = targetCard.getBoundingClientRect();
                const containerRect = teamSliderContainer.getBoundingClientRect();
                const scrollLeft = teamSliderContainer.scrollLeft;
                const cardLeft = cardRect.left - containerRect.left;
                
                teamSliderContainer.scrollTo({
                    left: scrollLeft + cardLeft - (containerRect.width - cardRect.width) / 2,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Update indicators on scroll
    teamSliderContainer.addEventListener('scroll', updateActiveIndicator, { passive: true });
    
    // Initial update
    updateActiveIndicator();
    
    // Update on resize
    window.addEventListener('resize', updateActiveIndicator, { passive: true });
}

// University Slider Functionality
const universitySliderContainer = document.getElementById('universitySliderContainer');
const universitySlideIndicators = document.getElementById('universitySlideIndicators');

if (universitySliderContainer && universitySlideIndicators) {
    const indicators = universitySlideIndicators.querySelectorAll('.slide-indicator');
    const cards = universitySliderContainer.querySelectorAll('.career-univ-logo');

    const updateActiveIndicator = () => {
        const containerRect = universitySliderContainer.getBoundingClientRect();
        const containerCenter = containerRect.left + containerRect.width / 2;

        let activeIndex = 0;
        let minDistance = Infinity;

        cards.forEach((card, index) => {
            const cardRect = card.getBoundingClientRect();
            const cardCenter = cardRect.left + cardRect.width / 2;
            const distance = Math.abs(containerCenter - cardCenter);

            if (distance < minDistance) {
                minDistance = distance;
                activeIndex = index;
            }
        });

        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === activeIndex);
        });
    };

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            const targetCard = cards[index];
            if (targetCard) {
                const cardRect = targetCard.getBoundingClientRect();
                const containerRect = universitySliderContainer.getBoundingClientRect();
                const scrollLeft = universitySliderContainer.scrollLeft;
                const cardLeft = cardRect.left - containerRect.left;

                universitySliderContainer.scrollTo({
                    left: scrollLeft + cardLeft - (containerRect.width - cardRect.width) / 2,
                    behavior: 'smooth'
                });
            }
        });
    });

    universitySliderContainer.addEventListener('scroll', updateActiveIndicator, { passive: true });
    updateActiveIndicator();
    window.addEventListener('resize', updateActiveIndicator, { passive: true });
}
