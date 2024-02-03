<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Preview Post")}}
            </h2>
            <div>
                <nav>
                    <ul class="flex space-x-4">
                        <li>
                            <a href="{{route('post.create')}}"
                               class="text-white bg-purple-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">
                                Categories
                            </a>
                        </li>
                        <li>
                            <a href="{{route('post.create')}}"
                               class="text-white bg-purple-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">
                                Tags
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </x-slot>

    <x-session-message/>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{route('post.publish')}}"
           class="text-white bg-blue-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">
            <i class="fa-regular fa-paper-plane"></i> Publish Post
        </a>
        <a href="{{route('post.edit', $post)}}"
           class="ml-5 text-white bg-green-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">
            <i class="fa-regular fa-pen-to-square"></i> Edit Post
        </a>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
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
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </div>

</x-app-layout>



