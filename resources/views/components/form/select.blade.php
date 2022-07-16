@props(['name', 'type' => 'text'])

<div>
    <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="{{$name}}">
        {{ucwords($name)}}
    </label>
    <select name="{{$name}}[]" multiple="multiple"
        class="category-select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>
@error($name)
<p class="text-red-600 text-sm italic mt-2">{{$message}}</p>
@enderror