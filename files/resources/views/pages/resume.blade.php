<x-layouts.main title="Resume" description="The resume of Kai Sato, Staff Design Engineer — experience, capabilities, and education. Prints clean with Cmd-P.">

    <x-sections.resume-header/>

    <x-sections.experience-list
        :items="$experience"
        heading="Experience"
        variant="full"/>

    <x-sections.skills-grid :items="$site->skills"/>

    <x-sections.education-list :items="$education"/>

</x-layouts.main>
