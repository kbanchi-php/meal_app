<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md">
        <h2 class="text-center text-lg font-bold pt-6 tracking-widest">食事記事投稿</h2>
        <form action="" method="post" enctype="multipart/form-data" class="rounded pt-3 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="title">
                    タイトル
                </label>
                <input type="text" name="title"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="タイトル" value="">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="category">
                    カテゴリー
                </label>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="category" value="1" checked>
                        <span class="ml-2">野菜</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="category" value="2">
                        <span class="ml-2">タンパク質</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="category" value="3">
                        <span class="ml-2">炭水化物</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="detail">
                    詳細
                </label>
                <textarea name="detail" rows="10"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    食事の画像
                </label>
                <input type="file" name="image" class="border-gray-300" onchange="previewImage(this);">
                <img id="preview" style="max-width:200px;">
            </div>
            <input type="submit" value="登録"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
    <script>
        function previewImage(obj) {
            var fileReader = new FileReader();
            fileReader.onload = (function() {
                document.getElementById('preview').src = fileReader.result;
            });
            fileReader.readAsDataURL(obj.files[0]);
        }
    </script>
</x-app-layout>
