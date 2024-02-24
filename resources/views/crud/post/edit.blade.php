<x-app-layout>
    <x-slot name="header">
        <div class="breadcrumbs-container">
            <h2>
                {{ Breadcrumbs::render('post.show', $post) }}
            </h2>
        </div>
    </x-slot>

    <x-session-message/>
    @include('crud.post.form')
</x-app-layout>


