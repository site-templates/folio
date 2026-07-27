@props([
    'label' => 'Next',
    'headingInk' => 'Have an idea worth building?',
    'headingMuted' => 'Let’s talk.',
    'body' => 'I take on a small number of collaborations each year — products, design systems, and prototypes that deserve real attention.',
    'buttonText' => 'hello@kaisato.dev',
    'buttonLink' => 'mailto:hello@kaisato.dev',
    'note' => 'Usually replies within 24 hours',
])
<!--
    The closing move: the dotted grid returns upside down, a two-tone
    invitation, and one accent button carrying the email address itself —
    the address is the call to action.
-->
<section class="relative overflow-hidden border-t border-line py-24 sm:py-32">
    <div class="dot-grid pointer-events-none absolute inset-x-0 bottom-0 h-[24rem] rotate-180"></div>

    <div class="relative mx-auto w-full max-w-6xl px-6 text-center">
        <p class="crosshair inline-block font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>{{ $label }}</p>

        <h2 class="mx-auto mt-8 max-w-[22ch] text-4xl leading-[1.08] font-display font-medium tracking-[-0.02em] text-balance sm:text-6xl" data-reveal>
            {{ $headingInk }}
            <span class="text-muted">{{ $headingMuted }}</span>
        </h2>

        <p class="reveal-1 mx-auto mt-6 max-w-[52ch] text-lg/7 text-pretty text-muted" data-reveal>{{ $body }}</p>

        <div class="reveal-2 mt-10 flex flex-col items-center gap-4" data-reveal>
            <a href="{{ $buttonLink }}" class="inline-flex items-center gap-2.5 rounded-full bg-accent px-7 py-3.5 font-mono text-[15px] font-medium text-accent-ink transition-opacity duration-200 hover:opacity-85">
                {{ $buttonText }}
                <svg viewBox="0 0 16 16" class="size-4 fill-current" aria-hidden="true">
                    <path fill-rule="evenodd" d="M2 8a.75.75 0 0 1 .75-.75h8.69L8.22 4.03a.75.75 0 0 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 0 1-1.06-1.06l3.22-3.22H2.75A.75.75 0 0 1 2 8Z" clip-rule="evenodd"/>
                </svg>
            </a>
            <p class="font-mono text-[11px] tracking-widest text-faint uppercase">{{ $note }}</p>
        </div>
    </div>
</section>
