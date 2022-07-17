<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 md:grid md:grid-cols-5 gap-4">

                    @include('layouts.partials._left-menu')

                    <div class="col-span-4">
                        <div class="flex justify-between mb-4">
                            <h3 class="mb-4 text-xl font-bold">Edit Post</h3>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="w-full">
                                <form action="/admin/posts/{{$post->id}}" method="POST" class="px-8 pb-8 mb-4"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <x-form.input name="title" :value="old('title', $post->title)" />
                                    <x-form.input name="slug" :value="old('slug', $post->slug)" />
                                    <x-form.input name="thumbnail" type="file" />
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                    <img src="/storage/{{$post->thumbnail}}" alt="" class="w-28 mt-4">
                                    <x-form.textarea name="excerpt">
                                        {{$post->excerpt}}
                                    </x-form.textarea>
                                    <x-form.textarea name="body">
                                        {{$post->body}}
                                    </x-form.textarea>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="categories">
                                            Featured?
                                        </label>
                                        <input type="checkbox" class="w-6 h-6" name="featured" {{$post->featured
                                        ==1?'checked':''}}
                                        id="">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4" for="categories">
                                            Select Category
                                        </label>
                                        <select name="categories[]" multiple="multiple"
                                            class="category-select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{ in_array($category->id,
                                                $postCategories) ? 'selected' : ' ' }}>
                                                {{$category->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('categories')
                                    <p class="text-red-600 text-sm italic mt-2">{{$message}}</p>
                                    @enderror
                                    <div class="flex items-center mt-8 justify-between">
                                        <x-form.button name="Update Post" />
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>