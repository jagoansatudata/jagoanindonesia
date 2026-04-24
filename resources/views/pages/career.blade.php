<x-layouts.app :title="'Karir — Jagoan Indonesia'">
    <x-career.navbar />

    <x-career.hero />

    <x-career.support />

    <x-career.experiences :intern-experiences="$internExperiences" :career-stats="$careerStats" />

    <x-career.university :universities="$universities" />

    <x-careers.positions />

    <x-career.cta />

    <section class="section section-alt" aria-labelledby="career-challenge-heading">
        <div class="container">
            <x-career.faq :faqs="$faqs" />
        </div>
    </section>
</x-layouts.app>
