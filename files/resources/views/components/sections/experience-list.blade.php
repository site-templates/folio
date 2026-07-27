@props([
    'items',
    'label' => '',
    'heading' => '',
    'variant' => 'full',
    'currentText' => 'Now',
])
<!--
    The experience timeline: mono dates, role and company, and the description
    when variant is full. The compact variant is the home-page snapshot. Fed
    by resources/data/collections/experience.json.
-->
<section class="relative py-14 sm:py-20">
    <div class="mx-auto w-full max-w-6xl px-6">

        @if ($label)
        <p class="crosshair inline-block font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>
        @endif

        @if ($heading)
        <h2 class="mt-8 text-3xl font-display font-medium tracking-[-0.02em] sm:text-4xl" data-reveal>{{ $heading }}</h2>
        @endif

        <div class="mt-10 border-t border-line" data-reveal>
            @foreach ($items as $item)
            <div class="grid gap-x-8 gap-y-2 border-b border-line py-6 sm:grid-cols-[10rem_1fr] sm:py-7">
                <div class="flex items-baseline gap-2.5">
                    <span class="font-mono text-xs text-faint">{{ $item->dates }}</span>
                    @if ($item->current)
                    <span class="inline-flex items-center gap-1.5 font-mono text-[10px] tracking-widest text-ink uppercase">
                        <span class="size-1.5 rounded-full bg-ink"></span>
                        {{ $currentText }}
                    </span>
                    @endif
                </div>
                <div>
                    <p class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                        <span class="text-lg font-medium tracking-tight text-ink">{{ $item->role }}</span>
                        <span class="text-sm text-muted">{{ $item->company }} · {{ $item->location }}</span>
                    </p>
                    @if ($variant == 'full')
                    <p class="mt-2 max-w-[68ch] text-sm/6 text-muted">{{ $item->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
