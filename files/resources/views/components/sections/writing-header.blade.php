@props([
    'writing',
    'label' => 'Writing',
])
<!--
    The essay opener: centered, quiet — mono date and read time, the title,
    and the description as a standfirst. The body follows in entry-body.
-->
<section class="relative pt-40 pb-4 sm:pt-44">
    <div class="mx-auto w-full max-w-2xl px-6 text-center">
        <p class="inline-flex flex-wrap items-center justify-center gap-x-3 font-mono text-[11px] tracking-widest text-faint uppercase" data-reveal>
            <span>{{ $label }}</span>
            <span aria-hidden="true">·</span>
            <span>{{ $writing->dateFormatted }}</span>
            <span aria-hidden="true">·</span>
            <span>{{ $writing->readTime }}</span>
        </p>

        <h1 class="mt-8 text-[2.2rem] leading-[1.12] font-display font-medium tracking-[-0.02em] text-balance sm:text-[3rem]" data-reveal>{{ $writing->title }}</h1>

        <p class="reveal-1 mt-6 text-lg/7 text-pretty text-muted" data-reveal>{{ $writing->description }}</p>
    </div>
</section>
