@props([
    'label' => '01 · Index',
    'headingInk' => 'Selected work,',
    'headingMuted' => 'built to last.',
    'body' => '',
])
<!--
    The interior-page opener: a mono index label pinned by crosshairs, then
    the same two-tone display headline grammar as the hero, at interior scale.
-->
<section class="relative pt-40 pb-6 sm:pt-44">
    <div class="mx-auto w-full max-w-6xl px-6">
        <p class="crosshair inline-block font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>

        <h1 class="mt-8 max-w-[24ch] text-[2.4rem] leading-[1.08] font-display font-medium tracking-[-0.02em] text-balance sm:text-[3.5rem]" data-reveal>
            {{ $headingInk }}
            <span class="text-muted">{{ $headingMuted }}</span>
        </h1>

        @if ($body)
        <p class="reveal-1 mt-6 max-w-[52ch] text-lg/7 text-pretty text-muted" data-reveal>{{ $body }}</p>
        @endif
    </div>
</section>
