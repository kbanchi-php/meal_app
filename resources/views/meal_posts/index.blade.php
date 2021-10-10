<x-app-layout>
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            <article class="w-full px-4 md:w-1/2 text-xl text-gray-800 leading-normal">
                <a href="">
                    <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                        Title</h2>
                    <h3>User Name</h3>
                    <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                        <span class="text-red-400 font-bold">NEW</span>
                        Create At
                    </p>
                    <img class="w-full mb-2" src="" alt="">
                    <p class="text-gray-700 text-base">{{ Str::limit('Body', 50) }}</p>
                </a>
            </article>
        </div>
    </div>
</x-app-layout>
