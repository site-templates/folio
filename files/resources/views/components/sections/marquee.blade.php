@props([
    'items',
    'label' => 'Tools of the trade',
])
<!--
    The stack marquee: two identical tracks loop between hairlines; the second
    is decoration for screen readers. CSS animates it (paused on hover, off
    under reduced motion) — fed by the stack list in resources/data/site.json.
-->
<section class="relative border-y border-line py-6">
    <p class="sr-only">{{ $label }}</p>
    <div class="marquee overflow-hidden">
        <div class="flex w-max">
            <div class="marquee-track flex shrink-0 items-center">
                @foreach ($items as $item)
                <span class="px-6 font-mono text-[13px] tracking-[0.2em] text-muted uppercase">{{ $item->text }}</span>
                <svg viewBox="0 0 8 8" class="size-1.5 shrink-0 fill-faint" aria-hidden="true"><circle cx="4" cy="4" r="4"/></svg>
                @endforeach
            </div>
            <div class="marquee-track flex shrink-0 items-center" aria-hidden="true">
                @foreach ($items as $item)
                <span class="px-6 font-mono text-[13px] tracking-[0.2em] text-muted uppercase">{{ $item->text }}</span>
                <svg viewBox="0 0 8 8" class="size-1.5 shrink-0 fill-faint" aria-hidden="true"><circle cx="4" cy="4" r="4"/></svg>
                @endforeach
            </div>
        </div>
    </div>
</section>
