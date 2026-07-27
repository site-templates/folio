@props([
    'items',
    'label' => '',
    'heading' => 'Capabilities',
])
<!--
    The capabilities grid — name plus detail pairs, two across, fed by
    site.json's skills key.
-->
<section class="relative py-10 sm:py-12">
    <div class="mx-auto w-full max-w-6xl px-6">

        @if ($label)
        <p class="crosshair inline-block font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>
        @endif

        @if ($heading)
        <h2 class="text-2xl font-display font-medium tracking-[-0.02em] sm:text-3xl" data-reveal>{{ $heading }}</h2>
        @endif

        <div class="mt-8 grid gap-x-12 gap-y-6 border-t border-line pt-8 sm:grid-cols-2" data-reveal>
            @foreach ($items as $item)
            <div class="flex flex-col gap-1.5">
                <p class="text-[15px] font-medium tracking-tight text-ink">{{ $item->name }}</p>
                <p class="font-mono text-xs/5 text-muted">{{ $item->detail }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
