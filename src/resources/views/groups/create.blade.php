<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grouping') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/groups" method="POST">
                        @csrf
                        <p>■ グループ数</p>
                        <input type="number" name="group_number" min="1" value="1">

                        <p class="mt-4">■ メンバー</p>
                        <div id="input_form" class="grid grid-cols-4 gap-4">
                            @for ($i = 0; $i < 4; $i++)
                            <input type="text" name="members[]" class="w-full" />
                            @endfor
                        </div>

                        <div class="mt-4">
                            <button type="button" onclick="createInputForm()" class="py-2.5 px-5 mr-2 mb-2 text-sm font-bold text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-blue-700">新規フォーム追加</button>
                            <button type="submit" class="text-white bg-blue-400 hover:bg-blue-600 font-bold rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">グループ分け開始</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function createInputForm()
        {
            const newInputForm = document.createElement("input");
            newInputForm.type = "text";
            newInputForm.name = "members[]";
            newInputForm.className = "w-full";

            console.log(document.querySelector("#input_form").appendChild(newInputForm));
        };
    </script>
</x-app-layout>
