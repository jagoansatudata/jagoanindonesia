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
