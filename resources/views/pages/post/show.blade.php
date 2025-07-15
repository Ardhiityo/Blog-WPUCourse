<x-layouts.app :title="'Article Detail'">
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:underline">&laquo; All
                        Blogs</a>
                    <address class="flex items-center my-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                src="{{ asset($post->user->avatar ? 'storage/' . $post->user->avatar : 'avatar.png') }}"
                                alt="{{ $post->user->name }}">
                            <div>
                                <a href="{{ route('posts.index', ['username' => $post->user->username]) }}"
                                    rel="author"
                                    class="text-xl block font-bold hover:underline text-gray-900 dark:text-white">{{ $post->user->name }}</a>
                                <p
                                    class="bg-primary-100 my-1 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                    <a href="{{ route('posts.index', ['category' => $post->category->slug]) }}"
                                        class="hover:underline">{{ $post->category->name }}</a>
                                </p>
                                <p class="text-gray-500 text-sm dark:text-gray-400"><time pubdate
                                        datetime="{{ $post->created_at }}"
                                        title="February 8th, 2022">{{ $post->created_at->diffForHumans() }}</time></p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $post->title }}
                    </h1>
                </header>
                <p>{!! $post->body !!}</p>
            </article>
        </div>
    </main>
</x-layouts.app>
