<div @class(['w-full', $class])>
    <label for="{{$name}}"
    class="text-white"
    >
        {{$label}}
    </label>
    @if($type === 'textarea')
        <textarea
            class="@error($name) mt-1 text-sm text-red-600 dark:text-red-400 @enderror"
            type="{{$type}}"
            id="{{$name}}"
            name="{{$name}}"
        >
              {{old($name, $value)}}
       </textarea>
    @else
        <input
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:border-indigo-500 @error($name)  text-red-600 dark:text-red-400 @enderror"
            type="{{$type}}"
            id="{{$name}}"
            name="{{$name}}"
            value="{{old($name, $value)}}"
        >
    @endif
    @error($name)
    <div class="mt-1 text-sm text-red-600 dark:text-red-400">
        {{$message}}
    </div>
    @enderror
</div>
