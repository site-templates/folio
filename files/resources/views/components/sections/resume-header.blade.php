@props([
    'label' => '04 · Resume',
    'name' => 'Kai Sato',
    'role' => 'Staff Design Engineer',
    'summary' => 'Ten years across design and engineering, specialized in the seam between them: design systems, product interfaces, and the motion and states that make software feel finished.',
    'email' => 'hello@kaisato.dev',
    'location' => 'San Francisco, CA',
    'website' => 'kaisato.dev',
    'showDownload' => '1',
    'downloadText' => 'Download PDF',
    'downloadLink' => '#',
    'printHint' => 'or press',
])
<!--
    The resume masthead: name, role, and contact line, with the download
    button and a keyboard hint — the page itself prints clean (site.css strips
    the chrome under print), so Cmd-P is a legitimate export path.
-->
<section class="relative pt-40 pb-4 sm:pt-44">
    <div class="mx-auto w-full max-w-6xl px-6">
        <p class="crosshair inline-block font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>

        <div class="mt-8 flex flex-wrap items-end justify-between gap-x-12 gap-y-8">
            <div>
                <h1 class="text-[2.4rem] leading-[1.08] font-display font-medium tracking-[-0.02em] sm:text-[3.5rem]" data-reveal>{{ $name }}</h1>
                <p class="reveal-1 mt-2 text-xl text-muted" data-reveal>{{ $role }}</p>
                <p class="reveal-2 mt-6 max-w-[56ch] text-[15px]/7 text-pretty text-muted" data-reveal>{{ $summary }}</p>
                <p class="reveal-2 mt-6 flex flex-wrap items-center gap-x-5 gap-y-2 font-mono text-xs text-faint" data-reveal>
                    <a href="mailto:{{ $email }}" class="link-draw text-muted">{{ $email }}</a>
                    <span aria-hidden="true">·</span>
                    <span>{{ $location }}</span>
                    <span aria-hidden="true">·</span>
                    <span>{{ $website }}</span>
                </p>
            </div>

            @if ($showDownload)
            <div class="reveal-3 flex flex-col items-start gap-3" data-reveal data-print-hide>
                <a href="{{ $downloadLink }}" class="inline-flex items-center gap-2.5 rounded-full bg-accent px-5 py-2.5 text-sm font-medium text-accent-ink transition-opacity duration-200 hover:opacity-85">
                    {{ $downloadText }}
                    <svg viewBox="0 0 16 16" class="size-3.5 fill-current" aria-hidden="true">
                        <path d="M8.75 2.75a.75.75 0 0 0-1.5 0v5.69L5.03 6.22a.75.75 0 0 0-1.06 1.06l3.5 3.5a.75.75 0 0 0 1.06 0l3.5-3.5a.75.75 0 0 0-1.06-1.06L8.75 8.44V2.75Z"/>
                        <path d="M3.5 9.75a.75.75 0 0 0-1.5 0v1.5A2.75 2.75 0 0 0 4.75 14h6.5A2.75 2.75 0 0 0 14 11.25v-1.5a.75.75 0 0 0-1.5 0v1.5c0 .69-.56 1.25-1.25 1.25h-6.5c-.69 0-1.25-.56-1.25-1.25v-1.5Z"/>
                    </svg>
                </a>
                <p class="font-mono text-[11px] text-faint">{{ $printHint }} <kbd class="key">⌘</kbd> <kbd class="key">P</kbd></p>
            </div>
            @endif
        </div>
    </div>
</section>
