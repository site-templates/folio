<x-layouts.main title="Home" description="Kai Sato — design engineer in San Francisco. Selected projects, essays on the craft, and a decade of shipping across design and code.">

    <x-sections.hero/>

    <x-sections.marquee :items="$site->stack"/>

    <x-sections.projects-grid
        :items="$project"
        label="01 · Selected work"
        heading="Recent projects"
        featuredOnly="1"
        showAll="1"
        allText="All projects"
        allLink="/projects"/>

    <x-sections.writings-list
        :items="$writing"
        label="02 · Writings"
        heading="Recent essays"
        featuredOnly="1"
        showAll="1"
        allText="All writings"
        allLink="/writings"/>

    <x-sections.experience-list
        :items="$experience"
        label="03 · Experience"
        heading="Where I’ve been"
        variant="compact"/>

    <x-sections.cta/>

</x-layouts.main>
