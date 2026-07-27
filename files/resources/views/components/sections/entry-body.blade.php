@props(['body' => ''])
<!--
    The long-form body for case studies and essays: the entry's content HTML
    rendered through the prose styles at reading width.
-->
<section class="relative py-12 sm:py-16">
    <div class="mx-auto w-full max-w-2xl px-6">
        <article class="prose">{!! $body !!}</article>
    </div>
</section>
