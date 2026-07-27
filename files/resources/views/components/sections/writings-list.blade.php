@props([
    'items',
    'label' => '',
    'heading' => '',
    'featuredOnly' => '',
    'showAll' => '',
    'allText' => 'All writings',
    'allLink' => '/writings',
    'showDescription' => '',
])
<!--
    The writings index: hairlined rows — mono date, title, read time, and an
    arrow that slides on hover. Fed by resources/data/collections/writing.json;
    featuredOnly="1" keeps only flagged entries (the home page teaser).
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

        <div class="mt-10 border-t border-line" data-reveal>
            @foreach ($items as $item)
            @if ($featuredOnly == '' || $item->featured)
            <a href="{{ $item->link }}" class="group grid items-baseline gap-x-8 gap-y-1 border-b border-line py-6 sm:grid-cols-[8rem_1fr_auto]">
                <span class="font-mono text-xs text-faint">{{ $item->dateFormatted }}</span>
                <span>
                    <span class="text-lg font-medium tracking-tight text-ink transition-colors duration-200 sm:text-xl">{{ $item->title }}</span>
                    @if ($showDescription)
                    <span class="mt-1 block max-w-[64ch] text-sm/6 text-muted">{{ $item->description }}</span>
                    @endif
                </span>
                <span class="flex items-center gap-3 font-mono text-xs text-faint">
                    {{ $item->readTime }}
                    <svg viewBox="0 0 16 16" class="size-3.5 fill-current transition-all duration-200 group-hover:translate-x-0.5 group-hover:fill-ink" aria-hidden="true">
                        <path fill-rule="evenodd" d="M2 8a.75.75 0 0 1 .75-.75h8.69L8.22 4.03a.75.75 0 0 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06-1.06l3.22-3.22H2.75A.75.75 0 0 1 2 8Z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>
