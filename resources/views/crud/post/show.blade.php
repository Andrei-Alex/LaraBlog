<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Breadcrumbs::render('post.show', $post) }}
            </h2>
        </div>
    </x-slot>

    <x-session-message/>

    <div class="crud-show-buttons-container">
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
                        class="crud-button-base"
                    />
                </form>
            @endif
            <x-crud-button
                :href="route('post.edit', $post)"
                type="edit"
                text="Edit"
                icon="fas fa-edit"
                rounded="none"
                class="crud-button-base @if($post->draft) rounded-l @endif"
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
                    class="crud-button-base"
                />
            </form>
        </div>
    </div>

    <x-crud-card>

        @if($post->image)
            <img class="crud-show-poster"
                 src="{{ asset('storage/' . $post->image) }}"
                 alt="Post Image">
        @endif

        <h2 class="crud-show-title">{{ $post->title }}</h2>

        <p class="crud-show-cateogry">Category: {{ $post->category->name ?? 'N/A' }}</p>

        <div class="crud-show-tag-container">
            <span>Tags:</span>
            @forelse($post->tags as $tag)
                <span>#{{ $tag->name }}</span>
            @empty
                <span>No Tags</span>
            @endforelse
        </div>

        <div class="crud-show-slug-container">
            <span>Slug:</span> {{ $post->slug }}
        </div>

        <div class="crud-show-content">
            {!! $post->content !!}
        </div>

    </x-crud-card>

</x-app-layout>



