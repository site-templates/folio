@props([
    'showStatus' => '1',
    'statusText' => 'Available for select projects',
    'avatar' => 'https://assets.ui.sh/avatars/3.webp?size=160',
    'avatarAlt' => 'Portrait of Kai Sato',
    'headingInk' => 'I design and build software',
    'headingMuted' => 'with unreasonable attention to detail.',
    'body' => 'Design engineer in San Francisco. For the last decade I have lived in the space between the design file and the codebase — shipping products, systems, and the occasional beautiful dead end.',
    'labelLocation' => 'Location',
    'valueLocation' => 'San Francisco, CA',
    'labelCurrently' => 'Currently',
    'valueCurrently' => 'Staff Design Engineer, Northwind',
    'labelEmail' => 'Email',
    'valueEmail' => 'hello@kaisato.dev',
    'showScrollHint' => '1',
    'scrollHint' => 'scroll',
])
<!--
    The opening statement: an availability chip, a two-tone display headline
    that rises line by line on load, then the intro copy beside a metadata
    rail. The dotted engineering grid sits behind everything.
-->
<section id="hero" class="relative overflow-hidden pt-40 pb-16 sm:pt-48 sm:pb-20">
    <div class="dot-grid pointer-events-none absolute inset-x-0 top-0 h-[36rem]"></div>

    <div class="relative mx-auto w-full max-w-6xl px-6">

        <div class="flex items-center gap-4" data-hero-fade>
            <img src="{{ $avatar }}" alt="{{ $avatarAlt }}" class="size-11 rounded-full object-cover outline-1 -outline-offset-1 outline-ink/10" loading="lazy">
            @if ($showStatus)
            <p class="inline-flex items-center gap-2 rounded-full border border-line bg-panel px-3.5 py-1.5 font-mono text-xs text-muted">
                <span class="relative flex size-1.5">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-ink opacity-40"></span>
                    <span class="relative inline-flex size-1.5 rounded-full bg-ink/80"></span>
                </span>
                {{ $statusText }}
            </p>
            @endif
        </div>

        <h1 class="mt-10 max-w-[20ch] text-5xl font-display font-medium tracking-tight text-balance sm:text-6xl lg:text-7xl">
            <span data-hero-clip class="block"><span data-hero-line class="block">{{ $headingInk }}</span></span>
            <span data-hero-clip class="block"><span data-hero-line class="block text-muted">{{ $headingMuted }}</span></span>
        </h1>

        <div class="mt-12 flex flex-wrap items-end justify-between gap-x-16 gap-y-10 sm:mt-16">
            <p class="max-w-[46ch] text-lg/7 text-pretty text-muted" data-hero-fade>{{ $body }}</p>

            <dl class="w-full max-w-xs shrink-0 text-sm" data-hero-fade>
                <div class="flex items-baseline justify-between gap-6 border-b border-line py-2.5">
                    <dt class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $labelLocation }}</dt>
                    <dd class="text-ink">{{ $valueLocation }}</dd>
                </div>
                <div class="flex items-baseline justify-between gap-6 border-b border-line py-2.5">
                    <dt class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $labelCurrently }}</dt>
                    <dd class="text-right text-ink">{{ $valueCurrently }}</dd>
                </div>
                <div class="flex items-baseline justify-between gap-6 py-2.5">
                    <dt class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $labelEmail }}</dt>
                    <dd><a href="mailto:{{ $valueEmail }}" class="link-draw text-ink">{{ $valueEmail }}</a></dd>
                </div>
            </dl>
        </div>

        @if ($showScrollHint)
        <p class="mt-16 inline-flex items-center gap-2 font-mono text-[0.6875rem] tracking-widest text-faint uppercase" data-hero-fade>
            {{ $scrollHint }}
            <svg viewBox="0 0 16 16" class="size-4 animate-bounce fill-current" aria-hidden="true">
                <path fill-rule="evenodd" d="M8 2a.75.75 0 0 1 .75.75v8.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.22 3.22V2.75A.75.75 0 0 1 8 2Z" clip-rule="evenodd"/>
            </svg>
        </p>
        @endif
    </div>
</section>
