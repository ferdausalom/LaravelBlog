<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 md:grid md:grid-cols-5 gap-4">

                    @include('layouts.partials._left-menu')

                    <div class="col-span-4">
                        <div class="flex justify-between mb-4">
                            <h3 class="mb-4 text-xl font-bold">Posts</h3>
                            <a href="admin/posts/create" class="px-4 py-2 bg-yellow-600 rounded-sm text-white">Add
                                Post</a>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            @if ($posts->count())
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Image
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-96">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            <img src="/storage/{{$post->thumbnail}}" alt="" class="w-16">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$post->title}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$post->status == 1? 'Published':'Unpublished'}}
                                        </td>
                                        <td class="px-6 py-4 flex">
                                            <a href="/admin/posts/{{$post->id}}/edit">
                                                <x-svg-icon name="edit-icon" class="text-green-400 cursor-pointer" />
                                            </a>
                                            <form action="/admin/posts/{{$post->id}}" method="post"
                                                class="mx-4 cursor-pointer">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <x-svg-icon name="delete-icon" class="text-red-400" />
                                                </button>
                                            </form>
                                            <x-svg-icon name="view-icon" class="text-blue-400 cursor-pointer" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-xl p-6 text-yellow-500">No post done yet!</p>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>