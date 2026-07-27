<!--
    The dynamic case-study page: serves /project/{slug} for every entry in
    resources/data/collections/project.json, with the matched entry bound in
    place of the collection. Add a project by adding an entry there — no new
    page file needed.
-->
<x-layouts.main :title="$project->title" :description="$project->summary">

    <x-sections.project-hero :project="$project"/>

    <x-sections.entry-body :body="$project->content"/>

    <x-sections.entry-nav
        allText="All projects"
        allLink="/projects"
        nextLabel="Next project"
        :nextTitle="$project->nextTitle"
        :nextLink="$project->nextLink"/>

</x-layouts.main>
