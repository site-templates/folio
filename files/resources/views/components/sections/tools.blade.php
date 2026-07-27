@props([
    'items',
    'label' => '03 · Uses',
    'heading' => 'The setup',
    'body' => 'The tools change slower than the work does. Current answers to the question everyone asks anyway.',
])
<!--
    The uses grid: mono-labelled cards for the setup — editor, terminal,
    stack, hardware. Fed by site.json's tools key.
-->
<section class="relative py-14 sm:py-16">
    <div class="mx-auto w-full max-w-6xl px-6">

        <p class="crosshair inline-block font-mono text-[0.6875rem] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>

        <div class="flex flex-wrap items-end justify-between gap-x-10 gap-y-4">
            <h2 class="mt-8 text-3xl font-display font-medium tracking-tight sm:text-4xl" data-reveal>{{ $heading }}</h2>
            @if ($body)
            <p class="max-w-[38ch] text-sm/6 text-muted" data-reveal>{{ $body }}</p>
            @endif
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $item)
            <div class="rounded-2xl border border-line bg-panel p-6" data-reveal>
                <p class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $item->name }}</p>
                <p class="mt-2.5 text-base/7 text-ink sm:text-[0.9375rem]/6">{{ $item->note }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
