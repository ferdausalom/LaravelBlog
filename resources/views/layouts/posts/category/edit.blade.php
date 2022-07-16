<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 md:grid md:grid-cols-5 gap-4">

                    @include('layouts.partials._left-menu')

                    <div class="col-span-4">
                        <div class="flex justify-between mb-4">
                            <h3 class="mb-4 text-xl font-bold">Edit Category</h3>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="w-full">
                                <form action="/admin/categories/{{$category->id}}" method="POST" class="px-8 pb-8 mb-4">
                                    @csrf
                                    @method('put')
                                    <x-form.input name="name" :value="old('name', $category->name)" />
                                    <div class="flex items-center mt-8 justify-between">
                                        <x-form.button name="Update Category" />
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