<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<form action=""
      method="post"
      enctype="multipart/form-data"
      class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    @csrf
    @method($post->id ? 'PATCH' : 'POST')
    <div class="mt-3">
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" placeholder="Post title" name="title"
               value="{{ old('title', $post->title) }}">
        @error('title')
        <p class="mt-1 text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>
    <div class="mt-3">
        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
        <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="file" id="image" name="image">
        @error('image')
        <p class="mt-1 text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>
    <div class="mt-3">
        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="category" name="category_id">
            <option value="">Select category</option>
            @foreach($categories as $category)
                <option @selected(old('category_id', $post->category_id) == $category->id) value="{{$category->id}}">
                    {{$category->name}}
                </option>
            @endforeach
        </select>
        @error('category_id')
        <p class="mt-1 text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>
    @php
        $tagsId = $post->tags()->pluck('id')->toArray();
    @endphp
    <div class="mt-3">
        <label for="tag" class="block text-sm font-medium text-gray-700">Tags</label>
        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="tag" name="tags[]" multiple>
            @foreach($tags as $tag)
                <option @selected(in_array($tag->id, $tagsId)) value="{{$tag->id}}">
                    {{$tag->name}}
                </option>
            @endforeach
        </select>
        @error('tags')
        <p class="mt-1 text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>
    <div class="mt-3">
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
        <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" placeholder="Post slug" name="slug"
               value="{{ old('slug', $post->slug) }}">
        @error('slug')
        <p class="mt-1 text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>

    <div class="mt-3">
        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Content title..."
                  name="content">{{ old('content', $post->content) }}</textarea>
        @error('content')
        <p class="mt-1 text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>

    <button type="submit" class="mt-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        @if($post->id)
            Edit
        @else
            Create
        @endif
    </button>
</form>
</div>
