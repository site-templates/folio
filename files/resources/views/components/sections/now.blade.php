@props([
    'items',
    'label' => '02 · Now',
    'heading' => 'What I’m up to',
    'promptPath' => '~/now',
    'updated' => 'Updated July 2026',
])
<!--
    The now panel: a terminal window listing what's actually in flight, fed
    by site.json's now_items. The title bar carries the classic three dots
    and a mono path — the developer wink of the About page.
-->
<section class="relative py-14 sm:py-16">
    <div class="mx-auto w-full max-w-6xl px-6">

        <p class="crosshair inline-block font-mono text-[0.6875rem] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>
        <h2 class="mt-8 text-3xl font-display font-medium tracking-tight sm:text-4xl" data-reveal>{{ $heading }}</h2>

        <div class="reveal-1 mt-10 overflow-hidden rounded-2xl border border-line bg-panel shadow-sm" data-reveal>
            <div class="flex items-center gap-2 border-b border-line px-5 py-3">
                <span class="size-2.5 rounded-full border border-line bg-raised"></span>
                <span class="size-2.5 rounded-full border border-line bg-raised"></span>
                <span class="size-2.5 rounded-full border border-line bg-raised"></span>
                <span class="ml-3 font-mono text-xs text-faint">{{ $promptPath }}</span>
                <span class="ml-auto font-mono text-[0.625rem] tracking-widest text-faint uppercase">{{ $updated }}</span>
            </div>
            <ul role="list" class="flex flex-col gap-4 px-5 py-6 sm:px-7">
                @foreach ($items as $item)
                <li class="flex gap-3.5 font-mono text-sm/6 text-muted">
                    <span class="shrink-0 select-none text-faint">▸</span>
                    <span>{{ $item->text }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
