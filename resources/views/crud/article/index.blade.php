<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr
                                @if ($article->deleted_at)
                                    class="bg-gray-800 text-gray-500"
                                @endif
                            >
                                <td class="px-5 py-5 border-b border-gray-700 text-sm text-b-300">
                                    {{$article->title}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm text-gray-300">
                                    {{$article->subtitle}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm text-gray-300">
                                    {{$article->content}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm text-gray-300">
                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <a href="{{route('article.edit', $article)}}" class="text-white bg-cyan-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">Edit</a>
                                        @can('delete', $article)
                                            <form action="{{route('article.destroy', $article)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
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
