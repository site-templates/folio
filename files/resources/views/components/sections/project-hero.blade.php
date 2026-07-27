@props([
    'project',
    'label' => 'Case study',
    'labelClient' => 'Client',
    'labelYear' => 'Year',
    'labelRole' => 'Role',
    'labelStack' => 'Stack',
    'externalText' => 'Visit live',
])
<!--
    The case-study opener: mono label, the project title at display scale, its
    summary, a metadata rail drawn from the collection entry, then the cover
    image with the parallax treatment.
-->
<section class="relative pt-40 pb-4 sm:pt-44">
    <div class="mx-auto w-full max-w-6xl px-6">
        <p class="crosshair inline-block font-mono text-[0.6875rem] tracking-widest text-faint uppercase" data-reveal>{{ $label }} · {{ $project->year }}</p>

        <h1 class="mt-8 max-w-[18ch] text-5xl font-display font-medium tracking-tight text-balance sm:text-6xl" data-reveal>{{ $project->title }}</h1>

        <div class="reveal-1 mt-8 flex flex-wrap items-end justify-between gap-x-16 gap-y-8" data-reveal>
            <p class="max-w-[48ch] text-lg/7 text-pretty text-muted">{{ $project->summary }}</p>

            <dl class="grid shrink-0 grid-cols-2 gap-x-10 gap-y-4 text-sm sm:grid-cols-4">
                <div>
                    <dt class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $labelClient }}</dt>
                    <dd class="mt-1 text-ink">{{ $project->client }}</dd>
                </div>
                <div>
                    <dt class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $labelYear }}</dt>
                    <dd class="mt-1 text-ink">{{ $project->year }}</dd>
                </div>
                <div>
                    <dt class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $labelRole }}</dt>
                    <dd class="mt-1 text-ink">{{ $project->role }}</dd>
                </div>
                <div>
                    <dt class="font-mono text-[0.6875rem] tracking-widest text-faint uppercase">{{ $labelStack }}</dt>
                    <dd class="mt-1 font-mono text-xs/5 text-ink">{{ $project->stack }}</dd>
                </div>
            </dl>
        </div>

        @if ($project->external)
        <p class="reveal-2 mt-6" data-reveal>
            <a href="{{ $project->external }}" rel="noopener" class="group inline-flex items-center gap-2 text-sm font-medium text-ink">
                <span class="link-draw">{{ $externalText }}</span>
                <svg viewBox="0 0 16 16" class="size-4 fill-current transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" aria-hidden="true">
                    <path fill-rule="evenodd" d="M4.22 11.78a.75.75 0 0 1 0-1.06L9.44 5.5H5.75a.75.75 0 0 1 0-1.5h5.5a.75.75 0 0 1 .75.75v5.5a.75.75 0 0 1-1.5 0V6.56l-5.22 5.22a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd"/>
                </svg>
            </a>
        </p>
        @endif

        <div class="reveal-2 mt-12" data-reveal>
            <div data-parallax class="aspect-[16/9] rounded-2xl bg-raised outline-1 -outline-offset-1 outline-ink/10">
                <div class="parallax-media">
                    <img src="{{ $project->image }}" alt="{{ $project->imageAlt }}" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>
