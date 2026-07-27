@props([
    'items',
    'label' => '',
    'heading' => 'Education',
])
<!--
    The education rows — same hairline grammar as the experience timeline,
    fed by resources/data/collections/education.json.
-->
<section class="relative py-10 sm:py-12">
    <div class="mx-auto w-full max-w-6xl px-6">

        @if ($label)
        <p class="crosshair inline-block font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>
        @endif

        @if ($heading)
        <h2 class="text-2xl font-display font-medium tracking-[-0.02em] sm:text-3xl" data-reveal>{{ $heading }}</h2>
        @endif

        <div class="mt-8 border-t border-line" data-reveal>
            @foreach ($items as $item)
            <div class="grid gap-x-8 gap-y-2 border-b border-line py-6 sm:grid-cols-[10rem_1fr]">
                <span class="font-mono text-xs text-faint">{{ $item->dates }}</span>
                <div>
                    <p class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                        <span class="text-lg font-medium tracking-tight text-ink">{{ $item->degree }}</span>
                        <span class="text-sm text-muted">{{ $item->school }}</span>
                    </p>
                    <p class="mt-2 max-w-[68ch] text-sm/6 text-muted">{{ $item->note }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
