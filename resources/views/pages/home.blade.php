<x-layouts.app :title="'Jagoan Indonesia'">
    <x-navbar />
        <x-section-hero :hero-sections="$heroSections" />

        <section class="section section-expertise" aria-labelledby="expertise-heading">
            <div class="container">
                <h2 id="expertise-heading" class="expertise-heading">
                    <span class="expertise-heading-line">We Drive Business Success</span>
                    <span class="expertise-heading-line expertise-heading-line--emphasis">Through Expertise and Strategy</span>
                </h2>
                <div class="expertise-grid">
                    <article class="expertise-card">
                        <div class="expertise-card-icon">
                            <img src="{{ asset('images/group.svg') }}" alt="" width="48" height="48" />
                        </div>
                        <h3>Program Inkubasi Bisnis</h3>
                        <p>Jagoan Indonesia menyediakan program inkubasi seperti Jagoan Bisnis, Jagoan Digital, dan Jagoan Tani, yang membantu startup dan UKM mengembangkan usaha mereka melalui pelatihan dan pendampingan.</p>
                    </article>
                    <article class="expertise-card">
                        <div class="expertise-card-icon">
                            <img src="{{ asset('images/collab.svg') }}" alt="" width="48" height="48" />
                        </div>
                        <h3>Kolaborasi dengan Ekosistem Jagoan</h3>
                        <p>Melalui ekosistem Jagoan, kami bermitra dengan perusahaan digital, agensi desain, serta tim analisis data untuk menghadirkan inovasi yang relevan.</p>
                    </article>
                    <article class="expertise-card">
                        <div class="expertise-card-icon">
                            <img src="{{ asset('images/strong-data.svg') }}" alt="" width="48" height="48" />
                        </div>
                        <h3>Penguatan Data dan Transformasi Digital Bisnis</h3>
                        <p>Jagoan Indonesia menawarkan inovasi bagi klien dengan cara mengubah data menjadi insight, digitalisasi, dan pengembangan sistem yang lebih efisien.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="tentang" class="section section-jagoan-suite" aria-label="Jagoan Academy and Jagoan Data">
            <div class="container">
                <h2 class="jagoan-suite-heading-sub">
                    <span>We Provide Modern Business</span>
                    <span class="jagoan-suite-heading-sub--bold">Consulting Solutions</span>
                </h2>

                <h3 class="jagoan-suite-heading jagoan-suite-heading--spaced">
                    <img
                        src="{{ asset('images/logo-jd.svg') }}"
                        alt="Jagoan Data"
                        class="jagoan-suite-heading-logo"
                        width="150"
                        height="34"
                    >
                </h3>
                <div class="jagoan-suite-grid jagoan-suite-grid--data" role="list">
                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-data.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Business &amp; Data Research</h4>
                        <p class="jagoan-suite-card-desc">Analisis, perencanaan, anggaran, kebijakan, dan evaluasi dampak yang bisa dipakai untuk pengambilan keputusan.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--data-1" aria-hidden="true">
                        <img
                                src="{{ asset('images/img-data.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>

                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-dashboard.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Dashboard Analytics</h4>
                        <p class="jagoan-suite-card-desc">Visualisasi data real-time untuk mendukung keputusan berbasis data yang akurat.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--data-2" aria-hidden="true">
                        <img
                                src="{{ asset('images/img-dashboard.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>

                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-process.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Process Digitalization</h4>
                        <p class="jagoan-suite-card-desc">Transformasi proses kerja agar lebih efisien, terintegrasi, dan terdokumentasi secara digital.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--data-3" aria-hidden="true">
                        <img
                                src="{{ asset('images/img-process.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>

                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-web.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Custom Web/App</h4>
                        <p class="jagoan-suite-card-desc">Pengembangan web dan aplikasi sesuai kebutuhan bisnis, mulai dari strategi hingga implementasi.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--data-4" aria-hidden="true">
                        <img
                                src="{{ asset('images/img-web.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>
                </div>

                <h3 class="jagoan-suite-heading">
                    <img
                        src="{{ asset('images/logo-ja.svg') }}"
                        alt="Jagoan Academy"
                        class="jagoan-suite-heading-logo jagoan-suite-heading-logo--academy"
                        width="250"
                        height="56"
                    >
                </h3>
                <div class="jagoan-suite-grid" role="list">
                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-business.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Business Incubation</h4>
                        <p class="jagoan-suite-card-desc">Lingkungan suportif dengan akses ke investor, pelanggan, pakar, dan komunitas.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--academy-1" aria-hidden="true">
                            <img
                                src="{{ asset('images/img-business.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>

                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-workshop.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Workshop &amp; Training</h4>
                        <p class="jagoan-suite-card-desc">Program pembelajaran praktis untuk meningkatkan kapasitas dan keterampilan instansi.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--academy-2" aria-hidden="true">
                            <img
                                src="{{ asset('images/img-workshop.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>

                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-mentoring.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Mentoring &amp; Fasilitation</h4>
                        <p class="jagoan-suite-card-desc">Pendampingan strategis yang berfokus pada penguatan soft skill dan pertumbuhan profesional.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--academy-3" aria-hidden="true">
                            <img
                                src="{{ asset('images/img-mentoring.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>

                    <article class="jagoan-suite-card" role="listitem">
                        <div class="jagoan-suite-card-icon">
                            <img src="{{ asset('images/icon-programs.svg') }}" alt="" width="85" height="59">
                        </div>
                        <h4 class="jagoan-suite-card-title">Programs &amp; Events</h4>
                        <p class="jagoan-suite-card-desc">Inisiatif kolaboratif yang mendorong inovasi dan keterlibatan komunitas.</p>
                        <div class="jagoan-suite-card-photo jagoan-suite-card-photo--academy-4" aria-hidden="true">
                            <img
                                src="{{ asset('images/img-programs.png') }}"
                                alt=""
                                class="jagoan-suite-card-photo-img"
                                loading="lazy"
                            >
                        </div>
                    </article>
                </div>
                
            </div>
        </section>

        <section class="section section-trusted" aria-labelledby="trusted-heading">
            <div class="container">
                <div class="trusted-layout">
                    <div class="trusted-copy">
                        <h2 class="trusted-heading" id="trusted-heading">
                            <span class="trusted-heading-line">
                                <span class="trusted-heading-text">Trusted</span>
                                <span class="trusted-heading-text trusted-heading-text--normal"> by Clients</span>
                            </span>
                            <span class="trusted-heading-line">
                                <span class="trusted-heading-text trusted-heading-text--normal">Across Industries</span>
                            </span>
                        </h2>
                        <p class="trusted-desc">
                            Menghadirkan solusi inovatif dan berdampak bersama mitra pemerintah, pendidikan, komunitas, dan swasta.
                        </p>
                    </div>

                    <div class="trusted-logos" role="list" aria-label="Client logos">
                        @if($clients->isNotEmpty())
                            @php
                                $all_clients = $clients->toArray();
                                // Create two sets for seamless loop
                                $duplicated_clients = array_merge($all_clients, $all_clients);
                            @endphp
                            
                            <!-- Top Row (Left to Right) -->
                            <div class="trusted-slider-row trusted-slider-row--top" role="list">
                                @foreach($duplicated_clients as $client)
                                    <span role="listitem" class="trusted-logo" aria-label="{{ $client['name'] }}">
                                        @if($client['logo_path'])
                                            <img src="{{ asset('storage/' . $client['logo_path']) }}" alt="{{ $client['name'] }}" class="w-full h-full object-contain">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-gray-400 text-xs text-center px-2">{{ Str::limit($client['name'], 15) }}</span>
                                            </div>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                            
                            <!-- Bottom Row (Right to Left) -->
                            <div class="trusted-slider-row trusted-slider-row--bottom" role="list">
                                @foreach(array_reverse($duplicated_clients) as $client)
                                    <span role="listitem" class="trusted-logo" aria-label="{{ $client['name'] }}">
                                        @if($client['logo_path'])
                                            <img src="{{ asset('storage/' . $client['logo_path']) }}" alt="{{ $client['name'] }}" class="w-full h-full object-contain">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-gray-400 text-xs text-center px-2">{{ Str::limit($client['name'], 15) }}</span>
                                            </div>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center text-gray-500 py-8">
                                <p>No clients available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section id="portofolio" class="section section-activities" aria-labelledby="activities-heading">
            <div class="container">
                <div class="activities-header">
                    <div class="activities-header-layout">
                        <div class="activities-title">
                            <h2 id="activities-heading" class="activities-heading">
                                <span class="activities-heading-line">Learn Something About</span>
                                <span class="activities-heading-strong">Our Activities</span>
                            </h2>
                        </div>
                        <div class="activities-description">
                            <p class="activities-desc">Jagoan Indonesia menjalankan aktivitas pengembangan kapasitas, inkubasi bisnis, kajian dan riset, serta implementasi sistem dan teknologi untuk mendukung pertumbuhan organisasi dan usaha secara berkelanjutan.</p>
                        </div>
                    </div>
                </div>
                
                <div class="activities-marquee" aria-label="Activities slider">
                    @php
                        $activities = App\Models\Activity::query()
                            ->where('is_published', true)
                            ->orderBy('sort_order')
                            ->orderByDesc('created_at')
                            ->take(4)
                            ->get();
                        $duplicated_activities = $activities->concat($activities);
                    @endphp

                    @if($activities->isNotEmpty())
                        <div class="activities-marquee-track" aria-hidden="true">
                            @foreach($duplicated_activities as $activity)
                                <article class="activity-card">
                                    <div class="activity-card-image">
                                        @if($activity->image_path)
                                            <img src="{{ asset('storage/'.$activity->image_path) }}" alt="{{ $activity->title }}" loading="lazy">
                                        @else
                                            <img src="{{ asset('images/img-sms.png') }}" alt="{{ $activity->title }}" loading="lazy">
                                        @endif
                                        @if($activity->category)
                                            <span class="activity-tag">{{ $activity->category }}</span>
                                        @endif
                                    </div>
                                    <h3 class="activity-card-title">{{ $activity->title }}</h3>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="section section-team" aria-labelledby="team-heading">
            <div class="container">
                <h2 id="team-heading" class="team-heading">
                    <span class="team-heading-line">Meet Our Professionals</span>
                    <span class="team-heading-strong">Team Member</span>
                </h2>

                <!-- Desktop Layout -->
                <div class="team-grid desktop-only">
                    
                    <div class="team-row team-row--top">
                        @forelse (isset($teamMembers) ? $teamMembers->take(4) : collect([]) as $index => $member)
                            <article class="member-card">
                                <div class="member-card-photo {{ $index == 1 ? 'photo-2' : '' }}{{ $index == 2 ? 'photo-3' : '' }}{{ $index == 3 ? 'photo-4' : '' }}" aria-hidden="true">
                                    @if ($member->photo)
                                        <img src="{{ $member->photo ? asset('images/team/' . $member->photo) : asset('images/' . $member->photo) }}" alt="{{ $member->name }}" loading="lazy">
                                    @else
                                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-gray-600">{{ substr($member->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="member-card-overlay">
                                    <h3>{{ $member->name }}</h3>
                                    <p>{{ $member->position }}</p>
                                </div>
                            </article>
                        @empty
                        <p class="text-center text-gray-500">No team members available.</p>
                    @endforelse
                    </div>

                    <div class="team-row team-row--bottom">
                        @forelse (isset($teamMembers) ? $teamMembers->skip(4)->take(3) : collect([]) as $index => $member)
                            <article class="member-card">
                                <div class="member-card-photo photo-{{ $index + 5 }}" aria-hidden="true">
                                    @if ($member->photo)
                                        <img src="{{ $member->photo ? asset('images/team/' . $member->photo) : asset('images/' . $member->photo) }}" alt="{{ $member->name }}" loading="lazy">
                                    @else
                                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-gray-600">{{ substr($member->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="member-card-overlay">
                                    <h3>{{ $member->name }}</h3>
                                    <p>{{ $member->position }}</p>
                                </div>
                            </article>
                        @empty
                        <p class="text-center text-gray-500">No additional team members.</p>
                    @endforelse
                    </div>
                </div>

                <!-- Mobile Slide Layout -->
                <div class="team-slider mobile-only">
                    <div class="team-slider-container" id="teamSliderContainer">
                        @forelse (isset($teamMembers) ? $teamMembers->take(7) : collect([]) as $index => $member)
                            <article class="member-card mobile-card" data-slide="{{ $index }}">
                                <div class="member-card-photo {{ $index == 1 ? 'photo-2' : '' }}{{ $index == 2 ? 'photo-3' : '' }}{{ $index == 3 ? 'photo-4' : '' }}{{ $index >= 4 ? 'photo-' . ($index + 1) : '' }}" aria-hidden="true">
                                    @if ($member->photo)
                                        <img src="{{ $member->photo ? asset('images/team/' . $member->photo) : asset('images/' . $member->photo) }}" alt="{{ $member->name }}" loading="lazy">
                                    @else
                                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-gray-600">{{ substr($member->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="member-card-overlay">
                                    <h3>{{ $member->name }}</h3>
                                    <p>{{ $member->position }}</p>
                                </div>
                            </article>
                        @empty
                        <p class="text-center text-gray-500">No team members available.</p>
                    @endforelse
                    </div>
                    
                    <!-- Slide Indicators -->
                    <div class="slide-indicators" id="slideIndicators">
                        @forelse (isset($teamMembers) ? $teamMembers->take(7) : collect([]) as $index => $member)
                            <button class="slide-indicator {{ $index == 0 ? 'active' : '' }}" data-slide="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
                        @empty
                        <p class="text-center text-gray-500">No team members available.</p>
                    @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-reviews" aria-labelledby="reviews-heading" style="background: #FFFFFF; padding: 80px 0 160px 0;">
            <div class="container">
                <div class="reviews-grid" style="display: flex; gap: 60px; align-items: center;">
                    <div class="reviews-left" style="flex: 1; display: flex; flex-direction: column; align-items: flex-start;">
                        <div class="reviews-header" style="width: 100%; margin-bottom: 0; padding-bottom: 0;">
                            <h2 id="reviews-heading" class="reviews-heading" style="margin: 0; font-size: 48px; font-weight: 700; line-height: 1.05; color: #111827;">
                                <span class="reviews-heading-line" style="display: block; font-weight: 400;">Client reviews</span>
                                <span class="reviews-heading-strong" style="display: block; font-weight: 700; color: #000000 !important;">&amp; Real success stories</span>
                                <div class="reviews-nav" aria-hidden="true" style="margin-top: 8px; display: flex; justify-content: flex-start !important; align-items: center; gap: 12px; width: 100%; margin-left: 0 !important; padding-left: 0 !important; text-align: left !important;">
                                    <button type="button" class="reviews-nav-btn" onclick="slideReviews('left')" style="width: 40px; height: 40px; border-radius: 50%; background: white; border: 3px solid #DB3D3E !important; color: #272525; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; margin: 0; transition: all 0.3s ease;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M15 18L9 12L15 6" stroke="#272525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="reviews-nav-btn" onclick="slideReviews('right')" style="width: 40px; height: 40px; border-radius: 50%; background: white; border: 3px solid #DB3D3E !important; color: #272525; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; margin: 0; transition: all 0.3s ease;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M9 18L15 12L9 6" stroke="#272525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </h2>
                        </div>
                    </div>

                    <div class="reviews-right" style="flex: 2.5; overflow: hidden;">
                        <div class="reviews-track" id="reviewsTrack" style="display: flex; gap: 24px; padding-right: 100px; transition: transform 0.3s ease;">
                            @forelse($clientReviews as $review)
                                <article class="review-card" style="width: 305px; height: 310px; flex-shrink: 0; background: white; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); padding: 24px; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';">
                                    <div class="review-card-star" aria-hidden="true" style="background: #FEE2E2; border-radius: 10px; width: 85px; height: 20px; padding: 2px 8px; display: inline-flex; align-items: center; justify-content: center;">
                                        <div class="star-rating" style="display: flex; gap: 1px;">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="{{ $i <= $review->rating ? '#F87171' : '#E5E7EB' }}"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="review-card-text" style="margin: 16px 0; color: #4B5563; line-height: 1.6; font-size: 12px;">
                                        {{ Str::limit($review->review_content, 150) }}
                                    </p>
                                    <div class="review-card-divider" aria-hidden="true" style="height: 1px; background: #e5e7eb; margin: 16px 0;"></div>
                                    <div class="review-card-author" style="display: flex; align-items: center; gap: 12px;">
                                        @if($review->avatar_path)
                                            <img src="{{ asset('storage/' . $review->avatar_path) }}" alt="{{ $review->reviewer_name }}" class="review-card-avatar" aria-hidden="true" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">
                                        @else
                                            <div class="review-card-avatar" aria-hidden="true" style="width: 48px; height: 48px; background: #e5e7eb; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <circle cx="12" cy="7" r="4" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="review-card-author-name" style="margin: 0; font-size: 16px; font-weight: 600; color: #111827;">{{ $review->reviewer_name }}</h3>
                                            @if($review->reviewer_title)
                                                <p class="review-card-author-role" style="margin: 0; font-size: 12px; color: #6B7280;">{{ $review->reviewer_title }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @empty
                                @for($i = 1; $i <= 3; $i++)
                                    <article class="review-card" style="width: 305px; height: 310px; flex-shrink: 0; background: white; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); padding: 24px; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';">
                                        <div class="review-card-star" aria-hidden="true" style="background: #FEE2E2; border-radius: 10px; width: 85px; height: 20px; padding: 2px 8px; display: inline-flex; align-items: center; justify-content: center;">
                                            <div class="star-rating" style="display: flex; gap: 1px;">
                                                @for($j = 1; $j <= 5; $j++)
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#F87171"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="review-card-text" style="margin: 16px 0; color: #4B5563; line-height: 1.6; font-size: 12px;">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc semper diam vitae
                                            hendrerit condimentum. Nulla odio purus, tempus at turpis hendrerit, feugiat accumsan massa.
                                        </p>
                                        <div class="review-card-divider" aria-hidden="true" style="height: 1px; background: #e5e7eb; margin: 16px 0;"></div>
                                        <div class="review-card-author" style="display: flex; align-items: center; gap: 12px;">
                                            <div class="review-card-avatar" aria-hidden="true" style="width: 48px; height: 48px; background: #e5e7eb; border-radius: 50%;"></div>
                                            <div>
                                                <h3 class="review-card-author-name" style="margin: 0; font-size: 16px; font-weight: 600; color: #111827;">Client Name {{ $i }}</h3>
                                                <p class="review-card-author-role" style="margin: 0; font-size: 12px; color: #6B7280;">Job Title</p>
                                            </div>
                                        </div>
                                    </article>
                                @endfor
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="section section-alt section-main-value"
        >
            <div class="container">
                <div class="split">
                    <div class="split-media" aria-hidden="true"></div>
                    <div class="split-content">
                        <h2>
                            <span class="main-value-heading-line">
                                Mari Wujudkan <span class="main-value-bold">Strategi</span>
                            </span>
                            <span class="main-value-heading-line">
                                yang <span class="main-value-accent">Berdampak Nyata</span>
                            </span>
                        </h2>
                        <p>Mari berkolaborasi bersama JagoanIndonesia untuk mewujudkan strategi yang dapat diekskusi dan berdampak nyata bagi pertumbuhan bisnis Anda.</p>
                        <a href="#contact" class="btn btn-dark" style="background: #272525 !important; border-radius: 24px !important; padding: 14px 32px !important; min-width: 180px !important; display: inline-flex !important; align-items: center !important; justify-content: center !important;">Hubungi Kami <img src="{{ asset('images/icon-arrow.svg') }}" alt="Arrow" style="width: 20px; height: 20px; margin-left: 8px; vertical-align: middle;"></a>
                    </div>
                </div>
            </div>
        </section>

        <section id="blog" class="section section-blog" aria-labelledby="blog-heading">
            <div class="container">
                <h2 id="blog-heading" class="blog-heading">
                    <span class="blog-heading-line">Best of Our</span>
                    <span class="blog-heading-line blog-heading-line--strong">Latest News &amp; Blogs</span>
                </h2>

                <!-- News Section -->
                <div class="news-blogs-section" style="margin-bottom: 60px;">
                    <div class="title-section" style="margin-bottom: 20px; text-align: center;">
                        <h3 class="section-title" style="font-size: 28px; font-weight: 700; color: #111827; margin: 0; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">News</h3>
                    </div>
                    <div class="button-section" style="display: flex; justify-content: flex-end; margin-bottom: 30px;">
                        <a href="{{ route('news') }}?category=news" class="view-all-btn" style="background: none; border: 1px solid #D1D5DB; border-radius: 9999px; color: #6B7280; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 8px 16px; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; transition: all 0.3s ease; text-decoration: none;" 
                            onmouseover="this.style.background='#F3F4F6'; this.style.borderColor='#9CA3AF'; this.style.color='#374151'; this.querySelector('svg path:nth-child(1)').setAttribute('stroke','#374151'); this.querySelector('svg path:nth-child(2)').setAttribute('stroke','#374151');"
                            onmouseout="this.style.background='none'; this.style.borderColor='#D1D5DB'; this.style.color='#6B7280'; this.querySelector('svg path:nth-child(1)').setAttribute('stroke','#6B7280'); this.querySelector('svg path:nth-child(2)').setAttribute('stroke','#6B7280');">
                            View All
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 5L19 12L12 19" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="news-carousel" style="display: flex; gap: 20px; overflow-x: auto; padding-bottom: 20px;">
                        @forelse($latestNews as $news)
                            <article class="news-card" style="min-width: 360px; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" 
                                onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)'; this.style.transform='translateY(-4px)';"
                                onmouseout="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'; this.style.transform='translateY(0)';"
                                onclick="window.location.href='{{ route('news.show', $news->slug) }}'">
                                <div style="width: 100%; height: 200px; background: url('{{ $news->image ? asset($news->image) : asset('images/news1.png') }}') center/cover; border-radius: 12px 12px 0 0;"></div>
                                <div style="padding: 20px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                        <span style="color: #6B7280; font-size: 12px; display: flex; align-items: center; gap: 6px;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <circle cx="12" cy="7" r="4" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            by <strong style="color: #374151;">{{ $news->author ?? 'Admin' }}</strong>
                                        </span>
                                        <span style="color: #6B7280; font-size: 12px; display: flex; align-items: center; gap: 6px;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <line x1="8" y1="9" x2="16" y2="9" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <line x1="8" y1="13" x2="12" y2="13" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{ $news->comments_count }} comments
                                        </span>
                                    </div>
                                    <h3 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #111827; line-height: 1.4; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                                        {{ Str::limit($news->title, 60) }}
                                    </h3>
                                    <div class="blog-card-actions" style="display: flex; justify-content: space-between; align-items: center;">
                                        <button style="display: flex; align-items: center; gap: 8px; background: none; border: 2px solid #E5E7EB; border-radius: 20px; color: #6B7280; font-size: 12px; font-weight: 600; cursor: pointer; padding: 6px 12px; transition: all 0.2s ease;"
                                                onmouseover="this.style.background='#F3F4F6'; this.style.borderColor='#9CA3AF'; this.style.color='#374151'; this.querySelector('span').style.background='#9CA3AF';"
                                                onmouseout="this.style.background='none'; this.style.borderColor='#E5E7EB'; this.style.color='#6B7280'; this.querySelector('span').style.background='#E5E7EB';"
                                                onclick="event.stopPropagation(); window.location.href='{{ route('news.show', $news->slug) }}'">
                                            <span style="width: 16px; height: 16px; background: #E5E7EB; border-radius: 50%; display: inline-block;"></span>
                                            Continue Reading
                                        </button>
                                        <span style="background: #FEE2E2; color: #DC2626; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; border: 2px solid #FEE2E2;">{{ $news->formatted_date }}</span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="empty-state" style="text-align: center; padding: 60px 20px; color: #6B7280;">
                                <p style="font-size: 16px; margin: 0;">No news available at the moment.</p>
                            </div>
                        @endforelse
                    </div>

                </div>

                <!-- Blogs Section -->
                <div class="news-blogs-section">
                    <div class="title-section" style="margin-bottom: 20px; text-align: center;">
                        <h3 class="section-title" style="font-size: 28px; font-weight: 700; color: #111827; margin: 0; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">Blogs</h3>
                    </div>
                    <div class="button-section" style="display: flex; justify-content: flex-end; margin-bottom: 30px;">
                        <a href="{{ route('news') }}?category=blog" class="view-all-btn" style="background: none; border: 1px solid #D1D5DB; border-radius: 9999px; color: #6B7280; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px; padding: 8px 16px; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; transition: all 0.3s ease; text-decoration: none;" 
                            onmouseover="this.style.background='#F3F4F6'; this.style.borderColor='#9CA3AF'; this.style.color='#374151'; this.querySelector('svg path:nth-child(1)').setAttribute('stroke','#374151'); this.querySelector('svg path:nth-child(2)').setAttribute('stroke','#374151');"
                            onmouseout="this.style.background='none'; this.style.borderColor='#D1D5DB'; this.style.color='#6B7280'; this.querySelector('svg path:nth-child(1)').setAttribute('stroke','#6B7280'); this.querySelector('svg path:nth-child(2)').setAttribute('stroke','#6B7280');">
                            View All
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 5L19 12L12 19" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>

                    <div class="blogs-carousel" style="display: flex; gap: 20px; overflow-x: auto; padding-bottom: 20px;">
                        @forelse($latestBlogs as $blog)
                            <article class="blog-card" style="min-width: 360px; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.3s ease; cursor: pointer;" 
                                onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.15)'; this.style.transform='translateY(-4px)';"
                                onmouseout="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'; this.style.transform='translateY(0)';"
                                onclick="window.location.href='{{ route('news.show', $blog->slug) }}'">
                                <div style="width: 100%; height: 200px; background: url('{{ $blog->image ? asset($blog->image) : asset('images/news1.png') }}') center/cover; border-radius: 12px 12px 0 0;"></div>
                                <div style="padding: 20px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                        <span style="color: #6B7280; font-size: 12px; display: flex; align-items: center; gap: 6px;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <circle cx="12" cy="7" r="4" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            by <strong style="color: #374151;">{{ $blog->author ?? 'Admin' }}</strong>
                                        </span>
                                        <span style="color: #6B7280; font-size: 12px; display: flex; align-items: center; gap: 6px;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <line x1="8" y1="9" x2="16" y2="9" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <line x1="8" y1="13" x2="12" y2="13" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{ $blog->comments_count }} comments
                                        </span>
                                    </div>
                                    <h3 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 700; color: #111827; line-height: 1.4; font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                                        {{ Str::limit($blog->title, 60) }}
                                    </h3>
                                    <div class="blog-card-actions" style="display: flex; justify-content: space-between; align-items: center;">
                                        <button style="display: flex; align-items: center; gap: 8px; background: none; border: 2px solid #E5E7EB; border-radius: 20px; color: #6B7280; font-size: 12px; font-weight: 600; cursor: pointer; padding: 6px 12px; transition: all 0.2s ease;"
                                                onmouseover="this.style.background='#F3F4F6'; this.style.borderColor='#9CA3AF'; this.style.color='#374151'; this.querySelector('span').style.background='#9CA3AF';"
                                                onmouseout="this.style.background='none'; this.style.borderColor='#E5E7EB'; this.style.color='#6B7280'; this.querySelector('span').style.background='#E5E7EB';"
                                                onclick="event.stopPropagation(); window.location.href='{{ route('news.show', $blog->slug) }}'">
                                            <span style="width: 16px; height: 16px; background: #E5E7EB; border-radius: 50%; display: inline-block;"></span>
                                            Continue Reading
                                        </button>
                                        <span style="background: #FEE2E2; color: #DC2626; font-size: 12px; font-weight: 600; padding: 6px 12px; border-radius: 20px; border: 2px solid #FEE2E2;">{{ $blog->formatted_date }}</span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="empty-state" style="text-align: center; padding: 60px 20px; color: #6B7280;">
                                <p style="font-size: 16px; margin: 0;">No blogs available at the moment.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </section>

        <section id="contact" class="section section-alt">
            <div class="container">
                <div class="contact-main-grid">
                    <!-- Left Column -->
                    <div class="contact-left">
                        <h2 class="contact-heading">
                            <span class="contact-heading-line">Mari <span class="contact-heading-accent">Diskusi</span> dan</span>
                            <span class="contact-heading-line">Berkolaborasi</span>
                        </h2>
                        <a href="#contact" class="btn btn-dark contact-cta">
                            Hubungi Kami
                            <img src="{{ asset('images/icon-arrow.svg') }}" alt="" class="contact-cta-icon" width="33" height="27">
                        </a>

                        <div class="contact-info-grid" aria-label="Informasi kontak">
                            <div class="contact-info-block">
                                <h3 class="contact-info-title">Jagoan Indonesia</h3>
                                <p class="contact-info-desc"><em>Business capability builder</em> yang mendukung pelaku usaha, institusi, dan komunitas membangun strategi yang terarah dan berkelanjutan.</p>
                                <div class="contact-social" aria-label="Social media">
                                    <a href="#" class="contact-social-link" aria-label="Facebook">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M18 2H15C13.6739 2 12.4021 2.52678 11.4645 3.46447C10.5268 4.40215 10 5.67392 10 7V10H7V14H10V22H14V14H17L18 10H14V7C14 6.73478 14.1054 6.48043 14.2929 6.29289C14.4804 6.10536 14.7348 6 15 6H18V2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="contact-social-link" aria-label="LinkedIn">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6 9H2V21H6V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4 6C5.10457 6 6 5.10457 6 4C6 2.89543 5.10457 2 4 2C2.89543 2 2 2.89543 2 4C2 5.10457 2.89543 6 4 6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="contact-social-link" aria-label="X">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M18 2H21L14 10L22 22H16L11 15L5 22H2L10 13L2 2H8L12 8L18 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="contact-social-link" aria-label="YouTube">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M22.54 6.42A2.78 2.78 0 0 0 20.58 4.46C18.88 4 12 4 12 4s-6.88 0-8.58.46A2.78 2.78 0 0 0 1.46 6.42C1 8.12 1 12 1 12s0 3.88.46 5.58A2.78 2.78 0 0 0 3.42 19.54C5.12 20 12 20 12 20s6.88 0 8.58-.46a2.78 2.78 0 0 0 1.96-1.96C23 15.88 23 12 23 12s0-3.88-.46-5.58Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.75 15.02L15.5 12L9.75 8.98V15.02Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="contact-info-block">
                                <h3 class="contact-info-title">Informasi Kontak</h3>
                                <ul class="contact-info-list">
                                    <li class="contact-info-item">
                                        <span class="contact-info-icon" aria-hidden="true">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22 16.92V19.92C22 20.47 21.78 21 21.39 21.39C21 21.78 20.47 22 19.92 22C10.88 22 2 13.12 2 4.08C2 3.53 2.22 3 2.61 2.61C3 2.22 3.53 2 4.08 2H7.08C7.59 2 8.08 2.19 8.46 2.54C8.84 2.89 9.08 3.37 9.14 3.89L9.5 6.89C9.56 7.41 9.38 7.93 9.01 8.3L7.13 10.18C8.55 12.73 10.27 14.45 12.82 15.87L14.7 13.99C15.07 13.62 15.59 13.44 16.11 13.5L19.11 13.86C19.63 13.92 20.11 14.16 20.46 14.54C20.81 14.92 21 15.41 21 15.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        <span>+62 812-3544-0045</span>
                                    </li>
                                    <li class="contact-info-item">
                                        <span class="contact-info-icon" aria-hidden="true">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 4H20V20H4V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4 4L12 13L20 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        <span>jagoanindonesiaku@gmail.com</span>
                                    </li>
                                    <li class="contact-info-item">
                                        <span class="contact-info-icon" aria-hidden="true">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 10C21 16 12 22 12 22C12 22 3 16 3 10C3 8.4087 3.63214 6.88258 4.75736 5.75736C5.88258 4.63214 7.4087 4 9 4C10.6569 4 12 5.34315 12 7C12 5.34315 13.3431 4 15 4C16.5913 4 18.1174 4.63214 19.2426 5.75736C20.3679 6.88258 21 8.4087 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <form class="contact-form contact-form--card" method="POST" action="{{ route('messages.store') }}" aria-label="Form kontak">
                            @csrf
                            <h3 class="contact-form-title">Jangan ragu untuk menghubungi atau mengunjungi kami</h3>
                            <div class="contact-form-fields">
                                <div class="contact-form-group">
                                    <input type="text" name="name" class="contact-form-input" placeholder="Nama" required />
                                </div>
                                <div class="contact-form-group">
                                    <input type="email" name="email" class="contact-form-input" placeholder="Email" required />
                                </div>
                                <div class="contact-form-group">
                                    <input type="tel" name="phone" class="contact-form-input" placeholder="No. Telepon" />
                                </div>
                                <div class="contact-form-group">
                                    <textarea name="message" class="contact-form-input contact-form-textarea" placeholder="Tulis pesan Anda" required></textarea>
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
                        <a href="#" class="contact-footer-link">Blog</a>
                        <span class="contact-footer-separator">|</span>
                        <a href="{{ route('career') }}" class="contact-footer-link">Karir</a>
                    </nav>
                </div>
            </div>
        </section>
    </x-layouts.app>

    <script>
        let currentSlideIndex = 0;
        let currentManualSlideIndex = 0;
        
        function slideReviews(direction) {
            const track = document.getElementById('reviewsTrack');
            const cards = track.querySelectorAll('.review-card');
            const cardWidth = 305;
            const gap = 24;
            const scrollAmount = cardWidth + gap;
            
            if (direction === 'left') {
                currentSlideIndex--;
                if (currentSlideIndex < 0) {
                    currentSlideIndex = cards.length - 1;
                }
            } else if (direction === 'right') {
                currentSlideIndex++;
                if (currentSlideIndex >= cards.length) {
                    currentSlideIndex = 0;
                }
            }
            
            const translateX = -currentSlideIndex * scrollAmount;
            track.style.transform = `translateX(${translateX}px)`;
        }

        function slideManualSlider(direction) {
            const track = document.getElementById('manualSliderTrack');
            if (!track) return;
            
            const slides = track.querySelectorAll('.manual-slider-slide');
            const indicators = document.querySelectorAll('.manual-slider-indicator');
            
            if (direction === 'left') {
                currentManualSlideIndex--;
                if (currentManualSlideIndex < 0) {
                    currentManualSlideIndex = slides.length - 1;
                }
            } else if (direction === 'right') {
                currentManualSlideIndex++;
                if (currentManualSlideIndex >= slides.length) {
                    currentManualSlideIndex = 0;
                }
            }
            
            updateManualSlider();
        }

        function goToSlide(index) {
            currentManualSlideIndex = index;
            updateManualSlider();
        }

        function updateManualSlider() {
            const track = document.getElementById('manualSliderTrack');
            if (!track) return;
            
            const slides = track.querySelectorAll('.manual-slider-slide');
            const indicators = document.querySelectorAll('.manual-slider-indicator');
            
            // Update slide position
            const slideWidth = 100 / slides.length;
            track.style.transform = `translateX(-${currentManualSlideIndex * slideWidth}%)`;
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentManualSlideIndex) {
                    indicator.classList.add('manual-slider-indicator--active');
                } else {
                    indicator.classList.remove('manual-slider-indicator--active');
                }
            });
        }

        // Auto-slide functionality (optional - can be disabled)
        let autoSlideInterval;
        
        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                slideManualSlider('right');
            }, 5000); // Change slide every 5 seconds
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // Add hover effects for navigation buttons
        document.addEventListener('DOMContentLoaded', function() {
            // Reviews slider hover effects
            const navButtons = document.querySelectorAll('.reviews-nav-btn');
            navButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#DB3D3E';
                    this.style.color = '#272525';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'white';
                    this.style.color = '#272525';
                });
            });

            // Manual slider hover effects
            const manualNavButtons = document.querySelectorAll('.manual-slider-nav-btn');
            manualNavButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#DB3D3E';
                    this.style.color = '#272525';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'white';
                    this.style.color = '#272525';
                });
            });

            // Stop auto-slide on hover, resume on mouse leave
            const sliderContainer = document.querySelector('.manual-slider-container');
            if (sliderContainer) {
                sliderContainer.addEventListener('mouseenter', stopAutoSlide);
                sliderContainer.addEventListener('mouseleave', startAutoSlide);
            }

            // Start auto-slide
            startAutoSlide();

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    slideManualSlider('left');
                } else if (e.key === 'ArrowRight') {
                    slideManualSlider('right');
                }
            });

            // Touch/swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;
            
            const manualSliderTrack = document.getElementById('manualSliderTrack');
            
            if (manualSliderTrack) {
                manualSliderTrack.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, false);
                
                manualSliderTrack.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                }, false);
            }
            
            function handleSwipe() {
                if (touchEndX < touchStartX - 50) {
                    slideManualSlider('right');
                }
                if (touchEndX > touchStartX + 50) {
                    slideManualSlider('left');
                }
            }
        });
    </script>
