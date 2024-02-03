<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center space-x-4">


            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __("Create new Post")}}
            </h2>

        </div>
    </x-slot>

    <x-session-message/>


        @include('crud.post.form')




</x-app-layout>
