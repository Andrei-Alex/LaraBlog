<div class="crud-form-container">
    <div class="crud-top-buttons-container">
        <form action="{{route($post->exists ? 'post.update' : 'post.store', $post)}}"
              method="post"
              enctype="multipart/form-data">
            @csrf
            @method($post->id ? 'PATCH' : 'POST')
            @if($post->id)
                <x-crud-button
                    text="Save"
                    type="edit"
                    icon="fas fa-edit"
                    rounded="true"
                    class="crud-button-base"
                />
            @else
                <x-crud-button
                    text="Create"
                    type="add"
                    icon="fas fa-paper-plane"
                    rounded="true"
                    class="crud-button-base"
                />

            @endif
            @if($post->draft)
                <form id="postForm" method="POST" action="{{ route('post.publish', $post) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="publish" value="true">
                    <button type="submit"
                            class="mb-5 text-white bg-blue-500 hover:bg-blue-700 font-medium py-2 px-4 text-sm rounded transition ease-in-out duration-150">
                        <i class="fa-regular fa-paper-plane"></i> Publish
                    </button>
                </form>
        @endif
    </div>
    <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-800">
        <div class="mt-3 flex w-full">
            <div class="w-9/12">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input type="text" name="title" placeholder="Post title" value="{{ old('title', $post->title) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500">
                @error('title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{$message}}</p>
                @enderror

            </div>

            <div class="w-3/12 ml-5">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                <input type="file" id="image" name="image"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500">
                @error('image')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="mt-3 flex w-full">
            <div class="w-8/12">
                <label for="category"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                <select id="category" name="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500">
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option
                            value="{{$category->id}}" @selected(old('category_id', $post->category_id) == $category->id)>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{$message}}</p>
                @enderror
            </div>
            @php
                $tagsId = $post->tags()->pluck('id')->toArray();
            @endphp
            <div class="w-4/12 ml-5">
                <label for="tag" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                <select id="tag" name="tags[]" multiple
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500">
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}" @selected(in_array($tag->id, $tagsId))>
                            {{$tag->name}}
                        </option>
                    @endforeach
                </select>
                @error('tags')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mt-3">
            <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
            <input type="text" name="slug" placeholder="Post slug" value="{{ old('slug', $post->slug) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500">
            @error('slug')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{$message}}</p>
            @enderror
        </div>
        <div class="mt-3">
            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
            <textarea name="content" style="display: none"
                      id="hiddenContent">{{ old('content', $post->content) }}</textarea>

            <div id="quill-editor"></div>

            @error('content')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{$message}}</p>
            @enderror
        </div>
    </div>
    </form>
</div>

@section('scripts')
    @vite(['resources/js/libraries/quill.js'])
    @vite(['resources/js/libraries/tomSelect.js'])
@endsection

