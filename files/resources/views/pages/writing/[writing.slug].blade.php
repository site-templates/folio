<!--
    The dynamic essay page: serves /writing/{slug} for every entry in
    resources/data/collections/writing.json, with the matched entry bound in
    place of the collection. Add an essay by adding an entry there — no new
    page file needed.
-->
<x-layouts.main :title="$writing->title" :description="$writing->description">

    <x-sections.writing-header :writing="$writing"/>

    <x-sections.entry-body :body="$writing->content"/>

    <x-sections.entry-nav
        allText="All writings"
        allLink="/writings"
        nextLabel="Read next"
        :nextTitle="$writing->nextTitle"
        :nextLink="$writing->nextLink"/>

</x-layouts.main>
