@props(['name', 'type' => 'text'])

@if ($type === 'checkbox')
<div>
    <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="{{$name}}">
        {{ucwords($name)}}
    </label>

    <input name="{{$name}}" type="{{$type}}" {{$attributes(['value'=> old($name)])}}
    >
</div>
@else
<div>
    <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="{{$name}}">
        {{ucwords($name)}}
    </label>

    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        name="{{$name}}" type="{{$type}}" {{$attributes(['value'=> old($name)])}}
    >
</div>
@endif
@error($name)
<p class="text-red-600 text-sm italic mt-2">{{$message}}</p>
@enderror