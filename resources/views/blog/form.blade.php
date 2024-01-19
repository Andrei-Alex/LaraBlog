    <form action="" method="post">
        @csrf
        @method($post->id() ?'PATCH' : "POST")
        <div class="form-group mt-3">
            <label for="title">Title</label>
            <input class="form-control" type="text" placeholder="Post title" name="title" value="{{old('title', $post->title)}}">
            @error('title')
            {{$message}}
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" placeholder="Post slug" name="slug" value="{{old('title', $post->slug)}}">
            @error('slug')
            {{$message}}
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="content">Content</label>
            <textarea class="form-control" placeholder="Content title..." name="content">{{old('content', $post->content)}}</textarea>
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

