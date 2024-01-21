@extends('base')

@section('title', 'Home Blog')
@section('content')
<h1>My Blog</h1>
    @foreach($posts as $post)
        <article>
            <h2>{{$post->title}}</h2>
            @if($post->category)
            <p class="small"> Category: <strong>{{$post?->category->name}}</strong></p>
            @endif
            @if(!$post->tags->isEmpty())
               @foreach($post->tags as $tag)
                   <span class="badge bg-secondary">{{ $tag->name }}</span>
               @endforeach
            @endif
            <p>{{$post->content}}</p>
            @if($post->image)
                <img style="width: 100%; height:250px; object-fit: cover" src="{{ $post->imageUrl()}}" alt="">
            @endif
            <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">Read more</a>
        </article>
    @endforeach
    {{$posts->links()}}
@endsection

