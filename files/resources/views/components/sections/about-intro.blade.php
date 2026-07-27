@props([
    'portrait' => 'https://assets.ui.sh/avatars/3.webp?size=640',
    'portraitAlt' => 'Portrait of Kai Sato',
    'body1' => 'I started as a designer who could code a little, became an engineer who could design a little, and eventually stopped believing the two were different jobs. The seam between them — motion, states, feel, the thousand decisions no mockup can hold — is where I have spent my whole career.',
    'body2' => 'These days I lead design engineering at Northwind, ship open source on the side, and write essays about the craft. The through-line is the same everywhere: software should feel like someone cared, because someone did.',
    'factLabel1' => 'Years shipping',
    'factValue1' => '10+',
    'factLabel2' => 'Products launched',
    'factValue2' => '38',
    'factLabel3' => 'GitHub stars',
    'factValue3' => '6.2k',
])
<!--
    The about opener: portrait beside the story, with a mono fact strip under
    the text. The portrait gets the parallax treatment like project imagery.
-->
<section class="relative py-14 sm:py-16">
    <div class="mx-auto w-full max-w-6xl px-6">
        <div class="grid gap-12 lg:grid-cols-[1fr_20rem] lg:gap-20">

            <div>
                <p class="text-lg/8 text-pretty text-ink" data-reveal>{{ $body1 }}</p>
                <p class="reveal-1 mt-6 text-lg/8 text-pretty text-muted" data-reveal>{{ $body2 }}</p>

                <dl class="reveal-2 mt-12 grid grid-cols-3 gap-6 border-t border-line pt-8" data-reveal>
                    <div>
                        <dd class="text-3xl font-display font-medium tracking-tight text-ink">{{ $factValue1 }}</dd>
                        <dt class="mt-1.5 font-mono text-[11px] tracking-widest text-faint uppercase">{{ $factLabel1 }}</dt>
                    </div>
                    <div>
                        <dd class="text-3xl font-display font-medium tracking-tight text-ink">{{ $factValue2 }}</dd>
                        <dt class="mt-1.5 font-mono text-[11px] tracking-widest text-faint uppercase">{{ $factLabel2 }}</dt>
                    </div>
                    <div>
                        <dd class="text-3xl font-display font-medium tracking-tight text-ink">{{ $factValue3 }}</dd>
                        <dt class="mt-1.5 font-mono text-[11px] tracking-widest text-faint uppercase">{{ $factLabel3 }}</dt>
                    </div>
                </dl>
            </div>

            <div class="reveal-1" data-reveal>
                <div data-parallax class="aspect-[4/5] rounded-2xl border border-line bg-raised">
                    <div class="parallax-media">
                        <img src="{{ $portrait }}" alt="{{ $portraitAlt }}" class="h-full w-full object-cover" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
