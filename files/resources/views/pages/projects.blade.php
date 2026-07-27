<x-layouts.main title="Projects" description="Selected work by Kai Sato — products, open source, and prototypes from 2023 to now.">

    <x-sections.page-header
        label="01 · Projects"
        headingInk="Selected work,"
        headingMuted="2023 to now."
        body="Products, open source, and one beautiful dead end. Each case study covers the brief, the decisions, and what actually happened after launch."/>

    <x-sections.projects-grid :items="$project"/>

    <x-sections.cta/>

</x-layouts.main>
