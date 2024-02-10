<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Blog Post Panel")}}
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
                :href="url()->previous()"
                type="info"
                icon="fas fa-tag"
            />
            <x-crud-button
                :href="route('post.create')"
                type="default"
                icon="fas fa-rotate-left"
            />
        </x-slot>

        <x-slot name="table">

            <thead>
            <tr>
                <th class="crud-table-title">
                    Title
                </th>
                <th class="crud-table-title">
                    Content
                </th>
                <th class="crud-table-title">
                    Tags
                </th>
                <th class="crud-table-title">
                    Category
                </th>
                <th class="crud-table-title">
                    Edit
                </th>
                @can('delete', array($posts[0]))
                    <th class="crud-table-title">
                        Actions
                    </th>
                @endcan

            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                        {{$post->title}}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                        {{Str::limit($post->content, 128, '...')}}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                        <div class="flex flex-col">
                            @foreach($post->tags as $tag )
                                <x-tag>
                                    {{$tag['name']}}
                                </x-tag>
                            @endforeach
                        </div>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                        {{$post->category['name']}}
                    </td>

                    <td class="px-5 py-5 border-b border-gray-700 text-sm
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
                        </div>

                    </td>
                    <td class="px-5 py-5 border-b border-gray-700 text-sm text-gray-300">

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

                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-slot>


        <x-slot name="pagination">
            {{ $posts->links('pagination::tailwind') }}
        </x-slot>
    </x-crud-container>


</x-app-layout>
