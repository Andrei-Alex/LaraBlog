<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method($post->id ? 'PATCH' : 'POST')
        <button type="submit"
                class="mb-5 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:focus:ring-indigo-700">
            @if($post->id)
                Edit
            @else
                Create
            @endif
        </button>

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

            </div>
            <div class="mt-3">
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
            <div class="mt-3">
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
                <textarea name="content" placeholder="Content title..."
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{$message}}</p>
                @enderror
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
