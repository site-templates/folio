<x-layouts.main title="About" description="Kai Sato — a design engineer's story: ten years in the seam between design and code, what's in flight now, and the setup behind it.">

    <x-sections.page-header
        label="02 · About"
        headingInk="Hi, I’m Kai."
        headingMuted="Good to meet you."/>

    <x-sections.about-intro/>

    <x-sections.now :items="$site->now_items"/>

    <x-sections.tools :items="$site->tools"/>

    <x-sections.cta/>

</x-layouts.main>
