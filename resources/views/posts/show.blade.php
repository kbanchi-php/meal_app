<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">
        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />
        <article class="mb-2">
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
            <img src="{{ Storage::url('images/posts/' . $post->image) }}" alt="image" class="mb-4">
            <p class="text-gray-700 text-base">{!! nl2br(e($post->body)) !!}</p>
        </article>
        @auth
            <div class="flex flex-row text-center my-4">
                @if (count($like) == 0)
                    <form action="{{ route('posts.likes.like', $post->id) }}" method="post"
                        onsubmit="checkDoubleSubmit(document.getElementById('likeBtn'));">
                        @csrf
                        <input id="likeBtn" type="submit" value="お気に入り"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-40">
                    </form>
                @else
                    <form action="{{ route('posts.likes.unlike', $post->id) }}" method="post"
                        onsubmit="checkDoubleSubmit(document.getElementById('unlikeBtn'));">
                        @csrf
                        @method('DELETE')
                        <input id="unlikeBtn" type="submit" value="お気に入り削除"
                            class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-40">
                    </form>
                @endif
            </div>
            <div class="flex flex-row text-center my-4">
                <p class="text-sm mb-2 md:text-base font-bold text-gray-600">
                    お気に入り数 : {{ count($post->likes) }}
                </p>
            </div>
            <div class="flex flex-row text-center my-4">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}"
                        class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
                    </form>
                @endcan
            </div>
        @endauth
    </div>
    <script>
        function checkDoubleSubmit(obj) {
            if (obj.disabled) {
                return false;
            } else {
                obj.disabled = true;
                return true;
            }
        }
    </script>
</x-app-layout>
