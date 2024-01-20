<form action="" method="post">
    @csrf
    @method($post->id?'PATCH' : "POST")
    <div class="form-group mt-3">
        <label for="title">Title</label>
        <input class="form-control" type="text" placeholder="Post title" name="title"
               value="{{old('title', $post->title)}}">
        @error('title')
        {{$message}}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="category">Category</label>
        <select class="form-control" id=category name="category_id">
            <option value="">Select category</option>
            @foreach($categories as $category)
                <option @selected(old('category_id', $post->category_id) === $category->id)
                        value={{$category->id}}>
                    {{$category->name}}
                </option>
            @endforeach
        </select>
        @error('category_id')
        {{$message}}
        @enderror
    </div>
    @php
        $tagsId = $post->tags()->pluck('id')
    @endphp
    <div class="form-group mt-3">
        <label for="tag">Tags</label>
        <select class="form-control" id="tag" name="tags[]" multiple>
            @foreach($tags as $tag)
                <option @selected($tagsId->contains($tag->id))
                        value={{$tag->id}}>
                    {{$tag->name}}
                </option>
            @endforeach
        </select>
        @error('tags')
        {{$message}}
        @enderror
    </div>
    <div class="form-group mt-3">
        <label for="slug">Slug</label>
        <input class="form-control" type="text" placeholder="Post slug" name="slug"
               value="{{old('title', $post->slug)}}">
        @error('slug')
        {{$message}}
        @enderror
    </div>

    <div class="form-group mt-3">
        <label for="content">Content</label>
        <textarea class="form-control" placeholder="Content title..."
                  name="content">{{old('content', $post->content)}}</textarea>
        @error('content')
        {{$message}}
        @enderror
    </div>

    <button class="btn btn-primary mt-3">
        @if($post->id)
            Edit
        @else
            Create
        @endif
    </button>
</form>

