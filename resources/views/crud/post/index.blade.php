<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Breadcrumbs::render('post.index') }}
            </h2>
        </div>
    </x-slot>

    <x-session-message/>


    <x-crud-container>
        <x-slot name="buttons">
            <x-crud-button
                :href="route('post.create')"
                type="add"
                icon="fas fa-plus"
            />
            <x-crud-button
                :href="route('post.create')"
                type="info"
                icon="fas fa-list"
            />
            <x-crud-button
                :href="route('post.create')"
                type="info"
                icon="fas fa-tag"
            />

        </x-slot>


        <x-slot name="search">
            <form action="{{ route('post.index') }}" method="GET">
                <div class="flex">
                    <input type="text"
                           name="search"
                           placeholder="Search by title"
                           value="{{ $filters['search'] ?? '' }}"
                           class="mt-1 block  rounded-l-md border-gray-300 shadow-sm
                       focus:border-indigo-300focus:ringfocus:ring-indigo-200 focus:ring-opacity-50
                       dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500"
                    >
                    <button
                        type="submit"
                        class="mt-1 px-2 rounded-r-md border-gray-300 shadow-sm
                               focus:border-indigo-300focus:ringfocus:ring-indigo-200 focus:ring-opacity-50
                               dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500"
                    >
                        Search
                    </button>
                </div>
                @if (!empty($filters['user_id']))
                    <input type="hidden" name="user_id" value="{{ $filters['user_id'] }}">
                @endif
                @if (!empty($filters['order_by']))
                    <input type="hidden" name="order_by" value="{{ $filters['order_by'] }}">
                @endif
                @if (!empty($filters['direction']))
                    <input type="hidden" name="direction" value="{{ $filters['direction'] }}">
                @endif
            </form>
        </x-slot>
        <x-slot name="table">

            <div class="crud-content">
                <div class="crud-test">
                    <div class="crud-table-header">
                        <p class="crud-table-title">Title</p>
                        <p class="crud-table-title">Category</p>
                        <p class="crud-table-title">Status</p>
                        <p class="crud-table-title">Actions</p>
                    </div>
                    <div class="">
                        @foreach($posts as $post)
                            <div class="crud-table-rows">
                                <div class="px-5 py-5 text-sm crud-element text-left
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    {{$post->title}}
                                </div>

                                <div class="px-5 py-5 text-sm text-left crud-element
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    {{Str::limit($post->category['name'], 128, '...')}}
                                </div>

                                <div class="px-5 crud-element py-5 text-sm text-left crud-element
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    <div class="flex flex-col">
                                        <div>
                                            @if(!$post->draft && !$post->deleted_at)
                                                <x-tag class="bg-green-500 dark:bg-green-300">
                                                    Published
                                                </x-tag>
                                            @elseif($post->draft && !$post->deleted_at)
                                                <x-tag class="bg-yellow-500 dark:bg-yellow-300">
                                                    Draft
                                                </x-tag>
                                            @else
                                                <x-tag class="bg-red-500 dark:bg-red-300">
                                                    Deleted
                                                </x-tag>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="px-5 py-5 text-sm text-left crud-element
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    <div class="flex">

                                        <x-crud-button
                                            :href="route('post.edit', $post)"
                                            text="Edit"
                                            type="edit"
                                            rounded="left"
                                            :disabled="$post->deleted_at !== null"
                                        />
                                        <x-crud-button
                                            :href="route('post.show', ['slug' => $post->slug, 'post' => $post])"
                                            text="Preview"
                                            type="preview"
                                            rounded="right"
                                            :disabled="$post->deleted_at !== null"
                                        />
                                        @can('delete', $post)
                                            <form action="
                                             @if (!$post->deleted_at)
                                             {{route('post.destroy', $post)}}
                                              @else
                                                  {{route('post.restore', $post)}}
                                              @endif
                                              "
                                                  method="post">
                                                @csrf
                                                @if (!$post->deleted_at)
                                                    @method('delete')
                                                    <button
                                                        class="text-white bg-red-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">
                                                        Delete
                                                    </button>
                                                @else
                                                    @method('PATCH')
                                                    <button
                                                        class="text-white bg-green-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">
                                                        restore
                                                    </button>
                                                @endif
                                            </form>
                                        @endcan
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-slot>


        <x-slot name="pagination">
            {{ $posts->links('pagination::tailwind') }}
        </x-slot>
    </x-crud-container>


</x-app-layout>
