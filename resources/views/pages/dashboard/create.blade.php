<x-app-layout>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden border sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative p-4 w-full max-w-full max-h-full">
                        <!-- Modal content -->
                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                            <!-- Modal header -->
                            <div
                                class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Post</h3>
                            </div>
                            <!-- Modal body -->
                            <form action="{{ route('dashboard.store') }}" method="POST" id="form">
                                @csrf
                                <div class="grid gap-4 mb-[150px] sm:grid-cols-2">
                                    <div>
                                        <label for="title"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                        <input type="text" name="title" id="title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
                                            @error('title')
                                                border-red-600 focus:border-red-600 focus:ring-red-500
                                            @enderror"
                                            placeholder="Type product name" autofocus value="{{ old('title') }}">
                                        @error('title')
                                            <p class="mt-2 text-xs text-red-600 dark:text-red-400">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="category_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Category
                                        </label>
                                        <select id="category_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
                                            @error('title')
                                                border-red-600 focus:border-red-600 focus:ring-red-500
                                            @enderror"
                                            name="category_id">
                                            <option selected="">Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="mt-2 text-xs text-red-600 dark:text-red-400">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="body"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Body
                                        </label>
                                        <textarea id="body" rows="4" class="hidden" name="body" autofocus></textarea>
                                        <div id="editor">{!! old('body') !!}</div>
                                        @error('body')
                                            <p class="mt-2 text-xs text-red-600 dark:text-red-400">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <button type="submit"
                                        class="text-white cursor-pointer inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Add new post
                                    </button>
                                    <a href="{{ route('dashboard.index') }}"
                                        class="text-white inline-flex cursor-pointer items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            const body = document.getElementById('body');
            const editor = document.getElementById('editor');
            const form = document.getElementById('form');

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const content = editor.children[0].innerHTML;
                body.value = content;
                form.submit();
            });
        </script>
    @endpush
</x-app-layout>
