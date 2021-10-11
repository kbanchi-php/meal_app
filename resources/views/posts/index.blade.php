<x-app-layout>
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <x-flash-message :message="session('notice')" />
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($posts as $post)
                <article class="w-full px-4 md:w-1/2 text-xl text-gray-800 leading-normal">
                    <a href="{{ route('posts.show', $post) }}">
                        <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                            {{ $post->title }}</h2>
                        <h3>{{ $post->user->name }}</h3>
                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                            <span class="text-red-400 font-bold">{{ $post->elapsed_time }}</span>
                            前に作成
                        </p>
                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                            記事作成日 : {{ $post->created_at }}
                        </p>
                        <img class="w-full mb-2" src="{{ $post->image_url }}" alt="image">
                        <p class="text-gray-700 text-base">{{ Str::limit($post->body, 50) }}</p>
                        <p class="text-2xl mb-2 font-bold text-gray-600">
                            お気に入り数 : {{ count($post->likes) }}
                        </p>
                    </a>
                </article>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
</x-app-layout>
