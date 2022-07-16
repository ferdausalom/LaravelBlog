@props(['name'])

<div>
    <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="{{$name}}">
        {{ucwords($name)}}
    </label>
    <textarea
        class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        name="{{$name}}" cols="30" rows="4" {{$attributes}}>{{$slot ?? false}}</textarea>
</div>
@error($name)
<p class="text-red-600 text-sm italic mt-2">{{$message}}</p>
@enderror