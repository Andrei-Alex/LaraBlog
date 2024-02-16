<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ Breadcrumbs::render('article.index') }}
        </h2>
    </x-slot>

    <x-session-message />

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
                                Edit
                            </th>
                            @can('delete', $articles[0])
                                <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            @endcan

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($article->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    {{$article->title}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($article->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    {{$article->subtitle}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($article->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    {{$article->content}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm
                                @if ($article->deleted_at)
                                    text-gray-500
                                    @else
                                    text-gray-300
                                @endif
                                ">
                                    <div>
                                        <a href="{{route('article.edit', $article)}}"
                                           class="text-white bg-cyan-500 hover:bg-blue-700 font-medium py-2 px-4 rounded transition ease-in-out duration-150">Edit</a>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm text-gray-300">

                                    @can('delete', $article)
                                        <form action="
                                             @if (!$article->deleted_at)
                                             {{route('article.destroy', $article)}}
                                              @else
                                                  {{route('article.restore', $article)}}
                                              @endif
                                              "
                                              method="post">
                                            @csrf
                                            @if (!$article->deleted_at)
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
