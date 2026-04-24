<x-layouts.app :title="'{$blog->title} - Jagoan Indonesia'">
    <x-navbar />
    
    <!-- Hero Section -->
    <section class="section-hero" id="hero" style="background-image: url('{{ $blog->image ? asset($blog->image) : asset('images/hero/hero-1.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container">
            <div class="hero-content">
                <span class="hero-tag">{{ $blog->category }}</span>
                <h1 class="hero-heading">{{ $blog->title }}</h1>
                <div class="flex items-center gap-4 text-white/90">
                    <span class="flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ $blog->author }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                            <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                            <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                            <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        {{ $blog->formatted_date }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Excerpt -->
            @if($blog->excerpt)
                <div class="bg-blue-50 border-l-4 border-blue-600 p-6 mb-8 rounded-r-lg">
                    <p class="text-lg text-gray-700 italic">{{ $blog->excerpt }}</p>
                </div>
            @endif

            <!-- Main Content -->
            <div class="prose prose-lg max-w-none">
                {!! nl2br(e($blog->content)) !!}
            </div>

            <!-- Categories and Tags -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="text-sm font-semibold text-gray-600">Category:</span>
                    <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 px-3 py-1 text-sm font-semibold">
                        {{ $blog->category }}
                    </span>
                    @if($blog->featured)
                        <span class="inline-flex items-center rounded-full bg-yellow-50 text-yellow-700 px-3 py-1 text-sm font-semibold">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-1">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" fill="currentColor"/>
                            </svg>
                            Featured
                        </span>
                    @endif
                </div>
            </div>

            <!-- Share and Back -->
            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Back to Blog
                </a>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Share this article:</span>
                    <div class="flex gap-2">
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition-colors">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-700 text-white flex items-center justify-center hover:bg-blue-800 transition-colors">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <rect x="2" y="9" width="4" height="12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="4" cy="4" r="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
            <div class="max-w-4xl mx-auto mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-white rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                            <div class="w-full h-48 bg-cover bg-center" style="background-image: url('{{ $relatedPost->image ?: asset('images/hero/hero-1.jpg') }}');">
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs text-gray-500">{{ $relatedPost->formatted_date }}</span>
                                    <span class="text-xs text-blue-600 font-semibold">{{ $relatedPost->category }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">{{ $relatedPost->title }}</h3>
                                <a href="{{ route('news.show', $relatedPost->slug) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm">
                                    Read More
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 12L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M13 9L16 12L13 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Contact Section -->
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
                <a href="{{ route('home') }}" class="contact-footer-logo" aria-label="Jagoan Indonesia - Beranda">
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
</x-layouts.app>
