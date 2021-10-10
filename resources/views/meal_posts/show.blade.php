<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">
        <article class="mb-2">
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                Title</h2>
            <h3>User Name</h3>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                Current Time :
                <span class="text-red-400 font-bold">Current Time</span>
            </p>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                Create At : Create At
            </p>
            <img src="" alt="" class="mb-4">
            <p class="text-gray-700 text-base">{!! nl2br(e('Body')) !!}</p>
        </article>
        <div class="flex flex-row text-center my-4">
            <form action="" method="post">
                @csrf
                <input type="submit" value="お気に入り登録"
                    class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-40">
            </form>
        </div>
        <div class="flex flex-row text-center my-4">
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                お気に入り数:1
            </p>
        </div>
        <div class="flex flex-row text-center my-4">
            <a href=""
                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
            <form action="" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
            </form>
        </div>
    </div>
</x-app-layout>
