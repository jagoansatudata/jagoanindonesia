<x-layouts.app :title="'News - Jagoan Indonesia'">
    <x-navbar />
    <section class="section-hero" id="hero">
        <div class="container">
            <div class="hero-content">
                <span class="hero-tag">OUR BLOG</span>
                <h1 class="hero-heading">Featured insights and articles</h1>
            </div>
        </div>
    </section>
<div class="container mx-auto px-4 py-12">

    <!-- Category Filter -->
    <div class="flex justify-center mb-12 mt-16 overflow-x-auto">
        <div class="flex justify-center gap-4 whitespace-nowrap" style="max-width: 100%;">
            @foreach($categories as $category)
                <a href="{{ route('news', ['category' => $category === 'View All' ? null : \App\Models\BlogCategory::where('name', $category)->first()?->slug]) }}" 
                   class="category-btn px-8 py-3 rounded-full text-base font-medium transition-all duration-300 {{ request()->get('category') === ($category === 'View All' ? null : \App\Models\BlogCategory::where('name', $category)->first()?->slug) || (request()->get('category') == null && $category === 'View All') ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 hover:border-gray-400' }}" 
                   style="font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 18px; min-width: fit-content;">
                    {{ $category }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @forelse($news as $article)
            <article class="news-card bg-white rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2 cursor-pointer"
                     style="font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                <!-- Article Image -->
                <div class="w-full h-56 bg-cover bg-center" style="background-image: url('{{ $article['image'] }}');">
                </div>
                
                <!-- Article Content -->
                <div class="p-6">
                    <!-- Meta Information -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500 text-sm flex items-center gap-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="7" r="4" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            by <strong class="text-gray-700">{{ $article['author'] }}</strong>
                        </span>
                        <span class="text-gray-500 text-sm flex items-center gap-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="8" y1="9" x2="16" y2="9" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="8" y1="13" x2="12" y2="13" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $article['comments'] }} comments
                        </span>
                    </div>
                    
                    <!-- Article Title -->
                    <h3 class="text-xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $article['title'] }}
                    </h3>
                    
                    <!-- Actions -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('news.show', $article['slug']) }}" class="flex items-center gap-2 bg-white border-2 border-gray-200 rounded-full text-gray-600 text-sm font-semibold hover:border-gray-300 hover:text-gray-700 transition-all duration-300 px-4 py-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 12L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M13 9L16 12L13 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Continue Reading
                        </a>
                        <span class="bg-red-50 text-red-600 text-sm font-semibold px-3 py-1 rounded-full border-2 border-red-50">
                            {{ $article['date'] }}
                        </span>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No blog posts found in this category.</p>
                <a href="{{ route('news') }}" class="inline-flex items-center gap-2 mt-4 text-blue-600 hover:text-blue-700 font-semibold">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    View all blog posts
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($blogs) && $blogs->hasPages())
        <div class="flex justify-center">
            {{ $blogs->links() }}
        </div>
    @endif
</div>

<!-- Discussion and Collaboration Section -->
<section class="section section-contact" id="contact">
    <div class="container">
        <div class="contact-main-grid">
            <!-- Left Column -->
            <div class="contact-left">
                <div class="contact-info-block">
                    <div class="contact-header">
                        <h2 class="contact-heading">
                            <span class="contact-heading-line">
                                Mari Wujudkan <span class="contact-heading-bold">Strategi</span>
                            </span>
                            <span class="contact-heading-line">
                                yang <span class="contact-heading-accent">Berdampak Nyata</span>
                            </span>
                        </h2>
                        <p class="contact-info-desc">Mari berkolaborasi bersama JagoanIndonesia untuk mewujudkan strategi yang dapat diekskusi dan berdampak nyata bagi pertumbuhan bisnis Anda.</p>
                        <a href="#" class="contact-cta">Hubungi Kami <img src="{{ asset('images/icon-arrow.svg') }}" alt="Arrow" class="contact-cta-icon"></a>
                    </div>

                    <div class="contact-info-grid">
                        <div class="contact-info-title">Hubungi Kami</div>
                        <ul class="contact-info-list">
                            <li class="contact-info-item">
                                <span class="contact-info-icon" aria-hidden="true">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 16.92V19.92C22 20.92 21 21.92 20 21.92C11 21.92 3 13.92 3 4.92C3 3.92 4 2.92 5 2.92H8C8.5 2.92 9 3.42 9 3.92V7.92C9 8.42 8.5 8.92 8 8.92H6C6 13.92 10 17.92 15 17.92V15.92C15 15.42 15.5 14.92 16 14.92H20C20.5 14.92 21 15.42 21 15.92V16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span>+62 21 1234 5678</span>
                            </li>
                            <li class="contact-info-item">
                                <span class="contact-info-icon" aria-hidden="true">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span>jagoanindonesiaku@gmail.com</span>
                            </li>
                            <li class="contact-info-item">
                                <span class="contact-info-icon" aria-hidden="true">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 10C21 16 12 22 12 22C12 22 3 16 3 10C3 5.58172 6.58172 2 11 2C13.5 2 15.5 3 16.5 4.5C17.5 3 19.5 2 22 2C22 2 21 5.58172 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span>Jl. Letjen S. Parman Gang IIIA No.19 Kel. Purwantoro, Kec. Blimbing, Kota Malang, Jawa Timur</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="contact-right">
                <form class="contact-form contact-form--card" aria-label="Form kontak">
                    <h3 class="contact-form-title">Jangan ragu untuk menghubungi atau mengunjungi kami</h3>
                    <div class="contact-form-fields">
                        <div class="contact-form-group">
                            <input type="text" name="name" class="contact-form-input" placeholder="Nama" />
                        </div>
                        <div class="contact-form-group">
                            <input type="email" name="email" class="contact-form-input" placeholder="Email" />
                        </div>
                        <div class="contact-form-group">
                            <input type="tel" name="phone" class="contact-form-input" placeholder="No. Telepon" />
                        </div>
                        <div class="contact-form-group">
                            <textarea name="message" class="contact-form-input contact-form-textarea" placeholder="Tulis pesan Anda"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark contact-submit">Kirim</button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="contact-footer">
            <a href="{{ route('home') }}" class="contact-footer-logo" aria-label="Jagoan Indonesia — Beranda">
                <img src="{{ asset('images/logo-ji.svg') }}" alt="" width="154" height="62" decoding="async">
            </a>
            <nav class="contact-footer-nav" aria-label="Menu bawah">
                <a href="{{ route('home') }}" class="contact-footer-link">Beranda</a>
                <span class="contact-footer-separator">|</span>
                <a href="#" class="contact-footer-link">Tentang</a>
                <span class="contact-footer-separator">|</span>
                <a href="#" class="contact-footer-link">Portofolio</a>
                <span class="contact-footer-separator">|</span>
                <a href="{{ route('news') }}" class="contact-footer-link">Blog</a>
                <span class="contact-footer-separator">|</span>
                <a href="{{ route('career') }}" class="contact-footer-link">Karir</a>
            </nav>
        </div>
    </div>
</section>

<style>
.news-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.category-btn {
    transition: all 0.2s ease;
}

.category-btn:hover {
    transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .text-4xl {
        font-size: 2.5rem;
    }
    
    .text-3xl {
        font-size: 1.875rem;
    }
    
    .lg\:grid-cols-2 {
        grid-template-columns: 1fr;
    }
    
    .space-y-6 > * + * {
        margin-top: 1rem;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Additional styling for better visual hierarchy */
.news-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.category-btn.active {
    background-color: white;
    color: #2563eb;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

/* Form styling improvements */
input:focus, textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* Social media icons hover effects */
.social-icon:hover {
    transform: scale(1.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.category-btn');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active state from all buttons
            categoryButtons.forEach(btn => {
                btn.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
                btn.classList.add('text-gray-600');
            });
            
            // Add active state to clicked button
            this.classList.remove('text-gray-600');
            this.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
            
            // Here you would typically filter the articles based on category
            const category = this.dataset.category;
            console.log('Filtering by category:', category);
        });
    });
});
</script>
</x-layouts.app>
