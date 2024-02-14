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
        <x-slot name="search">
            <form action="{{ route('post.index') }}" method="GET">
                <div class="flex align-center overflow-hidden">
                    <input type="text"
                           name="search"
                           placeholder="Search by title"
                           value="{{ $filters['search'] ?? '' }}"
                           class="block py-2 rounded-l-md border-gray-300 shadow-sm
                       focus:border-indigo-300focus:ringfocus:ring-indigo-200 focus:ring-opacity-50
                       dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500"
                    >
                    <select name="order_by"
                            class="border-gray-300 w-30 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500">
                        <option value="created_at">Sort By</option>
                        <option
                            value="created_at" {{ request()->order_by == 'created_at' && request()->direction == 'asc' ? 'selected' : '' }}>
                            Date Asc
                        </option>
                        <option
                            value="created_at" {{ request()->order_by == 'created_at' && request()->direction == 'desc' ? 'selected' : '' }}>
                            Date Desc
                        </option>
                    </select>
                    <button
                        type="submit"
                        class="px-2 py-2 rounded-r-md border-gray-300 shadow-sm
                               focus:border-indigo-300focus:ringfocus:ring-indigo-200 focus:ring-opacity-50
                               dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500"
                    >
                        Search
                    </button>

                    <x-crud-button
                        :href="route('post.index', array_merge(request()->all(),['user_id' => auth()->id()]))"
                        icon="fa fa-user"
                        type="restore"
                        class="ml-2 px-3 py-3 rounded-r"
                    />
                    <x-crud-button
                        :href="route('post.create')"
                        type="add"
                        icon="fas fa-plus"
                        class="ml-2 px-3 py-3 rounded-r"
                    />
                    <x-crud-button
                        :href="route('post.create')"
                        type="info"
                        icon="fas fa-list"
                        class="ml-2 px-3 py-3 rounded-r"
                    />
                    <x-crud-button
                        :href="route('post.create')"
                        type="info"
                        icon="fas fa-tag"
                        class="ml-2 px-3 py-3 rounded-r"
                    />


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
                <div class="crud-table">
                    <div class="crud-table-header">
                        <p class="crud-table-title">Title</p>
                        <p class="crud-table-title crud-element-sm-none">Content</p>
                        <p class="crud-table-title">Category</p>
                        <p class="crud-table-title">Status</p>
                        <p class="crud-table-title crud-actions">Actions</p>
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

                                <div class="px-5 py-5 text-sm text-left crud-text-content crud-element-sm-none
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    {{Str::limit($post->content, 64, '...')}}
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

                                <div class="px-5 crud-element py-5 text-sm
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

                                <div class="px-5 py-5 text-sm text-left crud-actions
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    <div class="flex">

                                        <x-crud-button
                                            :href="route('post.edit', $post)"
                                            icon="fa fa-edit"
                                            type="edit"
                                            rounded="none"
                                            class="px-3 py-3 crud-left-button-rows "
                                            :disabled="$post->deleted_at !== null"
                                        />
                                        <div class="crud-element-sm-none">
                                            <x-crud-button
                                                :href="route('post.show', ['slug' => $post->slug, 'post' => $post])"
                                                icon="fa fa-eye"
                                                type="preview"
                                                rounded="none"
                                                class="px-3 py-3"
                                                :disabled="$post->deleted_at !== null"
                                            />
                                        </div>
                                        @can('delete', $post)
                                            <form
                                                class="crud-element-sm-none"
                                                action="
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
                                                    <x-crud-button
                                                        icon="fa fa-trash"
                                                        type="danger"
                                                        rounded="right"
                                                        class="px-3 py-3 rounded-r"
                                                    />
                                                @else
                                                    @method('PATCH')
                                                    <x-crud-button
                                                        icon="fa fa-trash-can-arrow-up"
                                                        type="restore"
                                                        rounded="right"
                                                        class="px-3 py-3 rounded-r"
                                                    />
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
