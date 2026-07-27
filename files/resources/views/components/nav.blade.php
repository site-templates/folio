@props([
    'links',
    'brand' => 'Kai Sato',
    'ctaText' => 'Get in touch',
    'ctaLink' => 'mailto:hello@kaisato.dev',
    'showCta' => '1',
])
<header id="header" class="fixed inset-x-0 top-0 z-50">
    <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-6 px-6 py-4">

        <a href="/" aria-label="Homepage" class="inline-flex items-center gap-2.5 text-ink">
            <svg viewBox="0 0 32 32" class="size-5 shrink-0" aria-hidden="true">
                <path fill="currentColor" d="M4 8a4 4 0 0 1 4-4h4v3.2H8.8c-.9 0-1.6.7-1.6 1.6V12H4V8Zm24 0v4h-3.2V8.8c0-.9-.7-1.6-1.6-1.6H20V4h4a4 4 0 0 1 4 4ZM4 24v-4h3.2v3.2c0 .9.7 1.6 1.6 1.6H12V28H8a4 4 0 0 1-4-4Zm24 0a4 4 0 0 1-4 4h-4v-3.2h3.2c.9 0 1.6-.7 1.6-1.6V20H28v4ZM16 12.4a3.6 3.6 0 1 1 0 7.2 3.6 3.6 0 0 1 0-7.2Z"/>
            </svg>
            <span class="text-[0.9375rem] font-semibold tracking-tight">{{ $brand }}</span>
        </a>

        <nav aria-label="Main" class="flex items-center gap-1 max-md:hidden">
            @foreach ($links as $link)
            <a href="{{ $link->url }}" class="rounded-full px-3.5 py-1.5 text-sm text-muted hover:text-ink">{{ $link->text }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            @if ($showCta)
            <a href="{{ $ctaLink }}" class="inline-flex items-center gap-2 rounded-full bg-accent px-4 py-2 text-sm font-medium text-accent-ink hover:opacity-85 max-md:hidden">
                {{ $ctaText }}
            </a>
            @endif

            <!-- The mobile menu button — main.js toggles .menu-open on the html element. -->
            <button type="button" data-menu-button aria-label="Toggle menu" aria-expanded="false" class="flex size-9 items-center justify-center rounded-full border border-line text-ink md:hidden">
                <svg viewBox="0 0 16 16" class="size-4 fill-current" aria-hidden="true">
                    <path d="M2 4.75A.75.75 0 0 1 2.75 4h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75ZM2 8a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 8Zm0 3.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- The mobile panel: a glass sheet that slides down under the bar. -->
    <div data-mobile-panel class="absolute inset-x-0 top-full border-b border-line bg-canvas/95 backdrop-blur-xl md:hidden">
        <nav aria-label="Mobile" class="mx-auto flex w-full max-w-6xl flex-col gap-1 px-6 py-6">
            @foreach ($links as $link)
            <a href="{{ $link->url }}" class="rounded-xl px-3 py-2.5 text-base font-medium text-ink hover:bg-raised">{{ $link->text }}</a>
            @endforeach
            @if ($showCta)
            <a href="{{ $ctaLink }}" class="mt-3 inline-flex items-center justify-center rounded-full bg-accent px-4 py-2.5 text-sm font-medium text-accent-ink">{{ $ctaText }}</a>
            @endif
        </nav>
    </div>
</header>
