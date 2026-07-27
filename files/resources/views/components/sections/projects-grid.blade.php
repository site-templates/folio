@props([
    'items',
    'label' => '',
    'heading' => '',
    'featuredOnly' => '',
    'showAll' => '',
    'allText' => 'All projects',
    'allLink' => '/projects',
])
<!--
    The project grid: large image cards, two across, each one a single anchor.
    The image parallaxes gently on scroll (GSAP moves the inner media wrapper;
    the hover zoom lives on the img itself so the two transforms never fight).
    Pass featuredOnly="1" to show only entries flagged featured in
    resources/data/collections/project.json.
-->
<section class="relative py-14 sm:py-20">
    <div class="mx-auto w-full max-w-6xl px-6">

        @if ($label)
        <p class="crosshair inline-block font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>
        @endif

        <div class="flex flex-wrap items-end justify-between gap-x-10 gap-y-4">
            @if ($heading)
            <h2 class="mt-8 text-3xl font-display font-medium tracking-[-0.02em] sm:text-4xl" data-reveal>{{ $heading }}</h2>
            @endif

            @if ($showAll)
            <a href="{{ $allLink }}" class="group inline-flex items-center gap-2 text-sm font-medium text-muted transition-colors duration-200 hover:text-ink" data-reveal>
                {{ $allText }}
                <svg viewBox="0 0 16 16" class="size-3.5 fill-current transition-transform duration-200 group-hover:translate-x-0.5" aria-hidden="true">
                    <path fill-rule="evenodd" d="M2 8a.75.75 0 0 1 .75-.75h8.69L8.22 4.03a.75.75 0 0 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06-1.06l3.22-3.22H2.75A.75.75 0 0 1 2 8Z" clip-rule="evenodd"/>
                </svg>
            </a>
            @endif
        </div>

        <div class="mt-10 grid gap-x-8 gap-y-14 sm:mt-12 lg:grid-cols-2">
            @foreach ($items as $item)
            @if ($featuredOnly == '' || $item->featured)
            <a href="{{ $item->link }}" class="group block" data-reveal>
                <div data-parallax class="aspect-[4/3] rounded-2xl border border-line bg-raised">
                    <div class="parallax-media">
                        <img src="{{ $item->image }}" alt="{{ $item->imageAlt }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.03]" loading="lazy">
                    </div>
                </div>
                <div class="mt-5 flex items-baseline justify-between gap-6">
                    <h3 class="text-xl font-display font-medium tracking-tight text-ink">{{ $item->title }}</h3>
                    <span class="font-mono text-xs text-faint">{{ $item->year }}</span>
                </div>
                <p class="mt-1.5 max-w-[52ch] text-sm/6 text-muted">{{ $item->summary }}</p>
                <p class="mt-3 font-mono text-[11px] tracking-wide text-faint">{{ $item->role }} · {{ $item->stack }}</p>
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>
