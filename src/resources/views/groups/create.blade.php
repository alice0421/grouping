<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{ group_number: 2 }">
                    <form action="/groups" method="POST">
                        @csrf
                        <button type="submit" class="text-white bg-blue-400 hover:bg-blue-600 font-bold rounded-lg text-sm px-5 py-2.5 mr-2 mb-4">
                            グループ分け開始
                        </button>
                        
                        <p>■ グループ数</p>
                        <input readonly type="number" name="group_number" min="1" :value="group_number" class="mr-4" />
                        <button type="button" @click="group_number > 0 ? group_number-- : group_number = 0" onclick="removeGroupForm()" class="w-12 h-12 text-white text-center align-middle bg-red-400 hover:bg-red-600 font-bold rounded-full text-xl p-2.5 mr-2">
                            -
                        </button>
                        <button type="button" @click="group_number++" onclick="addGroupForm()" class="w-12 h-12 text-white text-center align-middle bg-blue-400 hover:bg-blue-600 font-bold rounded-full text-xl p-2.5">
                            +
                        </button>
                        

                        <p class="mt-4">■ グループ名（任意）</p>
                        <div id="group_form" class="grid grid-cols-4 gap-4">
                            @for ($i = 0; $i < 2; $i++)
                            <input type="text" name="group_name[]" class="w-full" />
                            @endfor
                        </div>
                        
                        <p class="mt-4">■ メンバー</p>
                        <button type="button" onclick="addMemberForm()" class="py-2.5 px-5 mr-2 my-2 text-sm font-bold text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-blue-700">
                            新規フォーム追加
                        </button>
                        <div id="member_form" class="mt-2 grid grid-cols-4 gap-4">
                            <input required type="text" name="members[]" class="w-full" />
                            @for ($i = 0; $i < 3; $i++)
                            <input type="text" name="members[]" class="w-full" />
                            @endfor
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addGroupForm()
        {
            const newForm = document.createElement("input");
            newForm.type = "text";
            newForm.name = "group_name[]";
            newForm.className = "w-full";

            document.querySelector("#group_form").appendChild(newForm);
        };

        function removeGroupForm()
        {
            const removeForm = document.getElementById("group_form").lastElementChild;

            removeForm.remove();
        };

        function addMemberForm()
        {
            const newForm = document.createElement("input");
            newForm.type = "text";
            newForm.name = "members[]";
            newForm.className = "w-full";

            document.querySelector("#member_form").appendChild(newForm);
        };
    </script>
</x-app-layout>
