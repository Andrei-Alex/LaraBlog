<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Breadcrumbs::render('post.show', $post) }}
            </h2>
        </div>
    </x-slot>

    <x-session-message/>

       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex">
            @if($post->draft)
                <form method="POST" action="{{ route('post.publish', $post) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="publish" value="true">
                    <x-crud-button
                        type="edit"
                        text="Publish"
                        rounded="left"
                        icon="fas fa-paper-plane"
                        class="x-crud-button-base"
                    />
                </form>
            @endif
                <x-crud-button
                    :href="route('post.edit', $post)"
                    type="edit"
                    text="Edit"
                    icon="fas fa-edit"
                    rounded="none"
                    class="x-crud-button"
                />
                <form method="POST" action="{{ route('post.publish', $post) }}">
                    @csrf
                    @method('delete')
                    <x-crud-button
                        :route="route('post.destroy', $post)"
                        icon="fa fa-trash"
                        type="danger"
                        text="Delete"
                        rounded="right"
                        class="x-crud-button"
                    />
                </form>
        </div>
    </div>

    <x-crud-card>

        @if($post->image)
            <img class="rounded-md mb-4 w-full object-cover h-48" src="{{ asset('storage/' . $post->image) }}"
                 alt="Post Image">
        @endif

        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-300 mb-3">{{ $post->title }}</h2>

        <p class="text-indigo-600 dark:text-indigo-400 mb-3">Category: {{ $post->category->name ?? 'N/A' }}</p>

        <div class="mb-3">
            <span class="text-gray-700 dark:text-gray-300">Tags:</span>
            @forelse($post->tags as $tag)
                <span
                    class="inline-block bg-gray-200 dark:bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 dark:text-gray-300 mr-2 mb-2">#{{ $tag->name }}</span>
            @empty
                <span
                    class="inline-block bg-gray-200 dark:bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 dark:text-gray-300 mr-2 mb-2">No Tags</span>
            @endforelse
        </div>

        <div class="mb-3 text-sm text-gray-600 dark:text-gray-400">
            <span class="font-semibold">Slug:</span> {{ $post->slug }}
        </div>

        <div class="text-gray-700 dark:text-gray-300 text-sm">
            {!! $post->content !!}
        </div>

    </x-crud-card>

</x-app-layout>



