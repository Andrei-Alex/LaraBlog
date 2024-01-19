@extends('base')

@section('title', 'Home Blog')
@section('content')
<h1>My Blog</h1>
    @foreach($posts as $post)
        <article>
            <h2>{{$post->title}}</h2>
            <p>{{$post->content}}</p>
            <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">Read more</a>
        </article>
    @endforeach
    {{$posts->links()}}
@endsection

