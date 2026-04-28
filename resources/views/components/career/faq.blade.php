@props(['faqs' => []])

<section id="faq" class="career-faq" aria-labelledby="career-faq-heading">
    <div class="faq-header">
        <h2 id="career-faq-heading" class="faq-title">
            <span class="faq-small">Here are</span><br>
            <span class="faq-large">Frequently Asked Questions</span>
        </h2>
    </div>

    <div class="faq-container">
        @forelse($faqs as $faq)
            <div class="faq-item">
                <div class="faq-question">
                    <h3>{{ $faq->question }}</h3>
                    <svg class="faq-chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="faq-answer">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-8">
                <p>Belum ada FAQ tersedia.</p>
            </div>
        @endforelse
    </div>
</section>

<style>
.career-faq {
    max-width: 800px;
    margin: 0 auto;
    padding: 10px 20px;
}

.faq-header {
    text-align: center;
    margin-bottom: 10px;
}

.faq-title {
    color: #272525;
    margin: 0;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.faq-small {
    font-size: 42px;
    font-weight: 400;
    color: #272525;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.faq-large {
    font-size: 2.5rem;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.faq-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.faq-item {
    background-color: #f8f9fa;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    cursor: pointer;
    user-select: none;
    transition: background-color 0.3s ease;
}

.faq-question:hover {
    background-color: #f0f1f3;
}

.faq-question h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #6B727E;
    flex: 1;
    padding-right: 16px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.faq-chevron {
    color: #6c757d;
    transition: transform 0.3s ease;
    flex-shrink: 0;
}

.faq-item.active .faq-chevron {
    transform: rotate(180deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
}

.faq-item.active .faq-answer {
    max-height: 500px;
    padding: 0 24px 20px 24px;
}

.faq-answer p {
    margin: 0;
    color: #272525;
    line-height: 1.6;
    font-size: 14px;
    font-weight: 400;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

@media (max-width: 768px) {
    .career-faq {
        padding: 20px 16px;
    }
    
    .faq-header {
        margin-bottom: 30px !important;
    }
    
    .faq-small {
        font-size: 24px !important;
    }
    
    .faq-large {
        font-size: 28px !important;
    }
    
    .faq-title {
        font-size: 28px !important;
    }
    
    .faq-container {
        gap: 12px !important;
    }
    
    .faq-item {
        border-radius: 8px !important;
    }
    
    .faq-question {
        padding: 16px 20px;
    }
    
    .faq-question h3 {
        font-size: 14px !important;
        line-height: 1.4 !important;
    }
    
    .faq-item.active .faq-answer {
        padding: 0 20px 16px 20px;
    }
    
    .faq-answer p {
        font-size: 13px !important;
        line-height: 1.5 !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });
});
</script>
