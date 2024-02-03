<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Blog Post Panel")}}
        </h2>
    </x-slot>


    <x-session-message/>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>

        </div>
        <a href="{{route('post.create')}}"
           class="text-white bg-green-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">
            <i class="fas fa-plus mr-2"></i>Add Post
        </a>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Title
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Subtitle
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Content
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Tags
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Edit
                            </th>
                            @can('delete', array($posts[0]))
                                <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
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
                                    {{$post->subtitle}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    {{$post->content}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($post->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    @foreach($post->tags as $tag )
                                        <div> {{$tag['name']}}
                                            </br>
                                        </div>
                                    @endforeach
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
                                    <div>
                                        <a href="{{route('post.edit', $post)}}"
                                           class="text-white bg-cyan-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">Edit</a>
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
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>


{{--@extends('base')--}}


{{--@section('content')--}}
{{--<h1>My Blog</h1>--}}
{{--    @foreach($posts as $post)--}}
{{--        <post>--}}
{{--            <h2>{{$post->title}}</h2>--}}
{{--            @if($post->category)--}}
{{--            <p class="small"> Category: <strong>{{$post?->category->name}}</strong></p>--}}
{{--            @endif--}}
{{--            @if(!$post->tags->isEmpty())--}}
{{--               @foreach($post->tags as $tag)--}}
{{--                   <span class="badge bg-secondary">{{ $tag->name }}</span>--}}
{{--               @endforeach--}}
{{--            @endif--}}
{{--            <p>{{$post->content}}</p>--}}
{{--            @if($post->image)--}}
{{--                <img style="width: 100%; height:250px; object-fit: cover" src="{{ $post->imageUrl()}}" alt="">--}}
{{--            @endif--}}
{{--            <a href="{{route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}">Read more</a>--}}
{{--        </post>--}}
{{--    @endforeach--}}
{{--    {{$posts->links()}}--}}
{{--@endsection--}}

