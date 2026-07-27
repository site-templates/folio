@props([
    'socials',
    'name' => 'Kai Sato',
    'tagline' => 'Design engineer. I build interfaces and the systems behind them.',
    'copyright' => '© 2026 Kai Sato',
    'metaLine' => 'San Francisco · 37.7749°N, 122.4194°W',
    'showTop' => '1',
])
<!--
    The site-wide footer: mark and tagline, the social links from site.json,
    then a mono meta line with the coordinates — the quiet developer signature.
-->
<footer class="relative border-t border-line">
    <div class="mx-auto w-full max-w-6xl px-6 py-14 sm:py-16">
        <div class="flex flex-wrap items-start justify-between gap-x-12 gap-y-10">

            <div>
                <a href="/" aria-label="Homepage" class="inline-flex items-center gap-2.5 text-ink">
                    <svg viewBox="0 0 32 32" class="size-5 shrink-0" aria-hidden="true">
                        <path fill="currentColor" d="M4 8a4 4 0 0 1 4-4h4v3.2H8.8c-.9 0-1.6.7-1.6 1.6V12H4V8Zm24 0v4h-3.2V8.8c0-.9-.7-1.6-1.6-1.6H20V4h4a4 4 0 0 1 4 4ZM4 24v-4h3.2v3.2c0 .9.7 1.6 1.6 1.6H12V28H8a4 4 0 0 1-4-4Zm24 0a4 4 0 0 1-4 4h-4v-3.2h3.2c.9 0 1.6-.7 1.6-1.6V20H28v4ZM16 12.4a3.6 3.6 0 1 1 0 7.2 3.6 3.6 0 0 1 0-7.2Z"/>
                    </svg>
                    <span class="text-[15px] font-semibold tracking-tight">{{ $name }}</span>
                </a>
                <p class="mt-4 max-w-[30ch] text-sm/6 text-muted">{{ $tagline }}</p>
            </div>

            <nav aria-label="Social" class="flex items-center gap-1">
                @foreach ($socials as $social)
                <a href="{{ $social->url }}" rel="noopener" class="rounded-full px-3 py-1.5 font-mono text-xs text-muted transition-colors duration-200 hover:text-ink">{{ $social->text }}</a>
                @endforeach
            </nav>
        </div>

        <div class="mt-12 flex flex-wrap items-center justify-between gap-x-8 gap-y-4 border-t border-line pt-6">
            <p class="text-xs text-muted">{{ $copyright }}</p>
            <p class="font-mono text-[11px] tracking-wide text-faint">{{ $metaLine }}</p>
            @if ($showTop)
            <a href="#" class="group inline-flex items-center gap-1.5 text-xs text-muted transition-colors duration-200 hover:text-ink">
                Back to top
                <svg viewBox="0 0 16 16" class="size-3 fill-current transition-transform duration-200 group-hover:-translate-y-0.5" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 14a.75.75 0 0 1-.75-.75V4.56L4.03 7.78a.75.75 0 0 1-1.06-1.06l4.5-4.5a.75.75 0 0 1 1.06 0l4.5 4.5a.75.75 0 0 1-1.06 1.06L8.75 4.56v8.69A.75.75 0 0 1 8 14Z" clip-rule="evenodd"/>
                </svg>
            </a>
            @endif
        </div>
    </div>
</footer>
