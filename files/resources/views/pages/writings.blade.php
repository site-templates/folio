<x-layouts.main title="Writings" description="Essays on design engineering, taste, tools, and the craft of shipping — by Kai Sato.">

    <x-sections.page-header
        label="02 · Writings"
        headingInk="Essays on the craft,"
        headingMuted="written slowly."
        body="Design engineering, taste, tools, and the discipline of finishing. A few essays a year, each one earned the hard way first."/>

    <x-sections.writings-list :items="$writing" showDescription="1"/>

    <x-sections.cta/>

</x-layouts.main>
