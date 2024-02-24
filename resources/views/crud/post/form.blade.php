<div class="crud-form-container">
    <div class="crud-form-top-buttons-container">
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
                    rounded="left"
                    class="crud-button-base {{ !$post->draft ? 'rounded-r' : '' }}"
                />
            @else
                <x-crud-button
                    text="Create"
                    type="add"
                    icon="fas fa-add"
                    rounded="left"
                    class="crud-button-base"
                />

            @endif
        </form>
        @if($post->draft)
            <form id="postForm" method="POST" action="{{ route('post.publish', $post) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="publish" value="true">
                <x-crud-button
                    text="Publish"
                    type="restore"
                    icon="fas fa-paper-plane"
                    rounded="right"
                    class="crud-button-base"
                />
            </form>
        @endif
    </div>
    <div class="crud-form-inner-container">
        <div class="crud-form-full-element-container">
            <div class="w-9/12">
                <x-crud-input
                    type="text"
                    name="title"
                    placeholder="Post title"
                    value="{{ old('title', $post->title) }}"
                />
            </div>
            <div class="w-3/12 ml-5">
                <x-crud-input
                    type="file"
                    name="image"
                    title="Upload Image"
                />
            </div>
        </div>
        <div class="crud-form-full-element-container">
            <div class="w-8/12">
                <label for="category"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                <select id="category"
                        name="category_id"
                        class="crud-form-select">
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
                        class="crud-text-select">
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
            <x-crud-input
                type="text"
                name="slug"
                title="Slug"
            />
        </div>
        <div class="mt-3">
            <label for="content" class="crud-text-content-label">Content</label>
            <textarea name="content" style="display: none"
                      id="hiddenContent">{{ old('content', $post->content) }}</textarea>
            <div id="quill-editor">
            </div>

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

