@props([
    'allText' => 'All projects',
    'allLink' => '/projects',
    'nextLabel' => 'Next up',
    'nextTitle' => '',
    'nextLink' => '',
])
<!--
    The end-of-entry crossroads: back to the index on the left, and when the
    entry declares a successor, the next piece as a large invitation on the
    right.
-->
<section class="relative py-12 sm:py-16">
    <div class="mx-auto w-full max-w-6xl px-6">
        <div class="flex flex-wrap items-end justify-between gap-x-16 gap-y-8 border-t border-line pt-10">

            <a href="{{ $allLink }}" class="group inline-flex items-center gap-2 text-sm font-medium text-muted transition-colors duration-200 hover:text-ink">
                <svg viewBox="0 0 16 16" class="size-3.5 fill-current transition-transform duration-200 group-hover:-translate-x-0.5" aria-hidden="true">
                    <path fill-rule="evenodd" d="M14 8a.75.75 0 0 1-.75.75H4.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L4.56 7.25h8.69A.75.75 0 0 1 14 8Z" clip-rule="evenodd"/>
                </svg>
                {{ $allText }}
            </a>

            @if ($nextLink)
            <a href="{{ $nextLink }}" class="group text-right">
                <span class="block font-mono text-[11px] tracking-widest text-faint uppercase">{{ $nextLabel }}</span>
                <span class="mt-2 flex items-center gap-3 text-2xl font-display font-medium tracking-tight text-ink sm:text-3xl">
                    {{ $nextTitle }}
                    <svg viewBox="0 0 16 16" class="size-5 fill-current transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true">
                        <path fill-rule="evenodd" d="M2 8a.75.75 0 0 1 .75-.75h8.69L8.22 4.03a.75.75 0 0 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06-1.06l3.22-3.22H2.75A.75.75 0 0 1 2 8Z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </a>
            @endif
        </div>
    </div>
</section>
