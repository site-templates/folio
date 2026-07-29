@props([
    'links',
    'brand' => 'Kai Sato',
    'avatar' => 'https://assets.ui.sh/avatars/3.webp?size=160',
    'avatarAlt' => 'Portrait of Kai Sato',
    'showStatus' => '1',
    'statusText' => 'Available for work',
    'showCta' => '1',
    'ctaText' => 'Get in touch',
    'ctaLink' => 'mailto:hello@kaisato.dev',
])
<!--
    The site-wide header. At rest it spans the full max-w-6xl measure with no
    background and no bottom edge — it simply floats over the page. As you
    scroll, main.js scrubs a single --nav-p variable from 0 to 1 and every
    piece below interpolates against it: the bar narrows to its content width,
    the glass pill fades up behind it, the avatar shrinks, and the availability
    line collapses into a dot on the avatar. One number, one smooth movement.
-->
<header id="header" class="fixed inset-x-0 top-0 z-50">

    <!-- Reading progress — a hairline that only shows once the pill is formed. -->
    <span data-scroll-progress class="nav-progress pointer-events-none absolute top-0 left-0 block h-px"></span>

    <div data-nav-bar class="nav-bar relative grid items-center">

        <!-- The pill itself: one layer that inherits the bar's animated box. -->
        <span data-nav-glass class="nav-glass pointer-events-none absolute inset-0 rounded-full"></span>

        <!-- The user card: avatar, name, and the availability line beneath it. -->
        <a href="/" data-nav-item aria-label="Homepage" class="nav-card relative flex min-w-0 items-center">
            <span class="nav-avatar relative block shrink-0">
                <img src="{{ $avatar }}" alt="{{ $avatarAlt }}" class="size-full rounded-full object-cover outline-1 -outline-offset-1 outline-ink/10">
                @if ($showStatus)
                <!-- The status dot fades onto the avatar exactly as the line below collapses. -->
                <span class="nav-dot absolute right-0 bottom-0 flex items-center justify-center rounded-full bg-canvas">
                    <span class="size-1.5 rounded-full bg-live"></span>
                </span>
                @endif
            </span>

            <span class="min-w-0">
                <span class="nav-name block truncate font-semibold tracking-tight text-ink">{{ $brand }}</span>
                @if ($showStatus)
                <span data-nav-badge class="nav-badge font-mono text-[0.625rem] whitespace-nowrap text-muted">
                    <span class="relative flex size-1.5 shrink-0">
                        <span class="absolute inline-flex size-full animate-ping rounded-full bg-live opacity-70"></span>
                        <span class="relative inline-flex size-1.5 rounded-full bg-live"></span>
                    </span>
                    {{ $statusText }}
                </span>
                @endif
            </span>
        </a>

        <!-- The links, with a pill indicator that slides between them on hover. -->
        <nav aria-label="Main" data-nav-item data-nav-links class="relative flex items-center gap-0.5 max-md:hidden">
            <span data-nav-indicator class="nav-indicator pointer-events-none absolute inset-y-0 left-0 rounded-full"></span>
            @foreach ($links as $link)
            <a href="{{ $link->url }}" data-nav-link class="nav-link relative rounded-full px-3.5 py-1.5 text-sm text-muted">{{ $link->text }}</a>
            @endforeach
        </nav>

        <div data-nav-item class="flex items-center justify-end gap-2">
            @if ($showCta)
            <a href="{{ $ctaLink }}" class="nav-cta inline-flex items-center gap-1.5 rounded-full bg-accent font-medium text-accent-ink max-md:hidden">
                {{ $ctaText }}
                <svg viewBox="0 0 16 16" class="nav-cta-arrow size-3.5 fill-current" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.22 3.47a.75.75 0 0 1 1.06 0l4 4a.75.75 0 0 1 0 1.06l-4 4a.75.75 0 0 1-1.06-1.06L8.69 8 5.22 4.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                </svg>
            </a>
            @endif

            <!-- The mobile menu button — main.js toggles .menu-open on the html element. -->
            <button type="button" data-menu-button aria-label="Toggle menu" aria-expanded="false" class="nav-menu flex items-center justify-center rounded-full border border-line text-ink md:hidden">
                <svg viewBox="0 0 16 16" class="size-4 fill-current" aria-hidden="true">
                    <path d="M2 4.75A.75.75 0 0 1 2.75 4h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75ZM2 8a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 8Zm0 3.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- The mobile panel: a glass sheet that drops under the bar. -->
    <div data-mobile-panel class="absolute inset-x-0 top-full px-4 md:hidden">
        <nav aria-label="Mobile" class="mobile-sheet flex flex-col gap-1 rounded-3xl border border-line bg-canvas/95 p-3 backdrop-blur-xl">
            @foreach ($links as $link)
            <a href="{{ $link->url }}" class="rounded-2xl px-4 py-2.5 text-base font-medium text-ink hover:bg-raised">{{ $link->text }}</a>
            @endforeach
            @if ($showCta)
            <a href="{{ $ctaLink }}" class="mt-2 inline-flex items-center justify-center rounded-full bg-accent px-4 py-3 text-sm font-medium text-accent-ink">{{ $ctaText }}</a>
            @endif
        </nav>
    </div>
</header>
