<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grouping Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 pb-2 text-2xl font-bold border-b border-gray-300">用途: {{ $maker->title }}</div>
                <div class="flex flex-row px-6 pt-2 pb-6 text-gray-900">
                    <div class="w-1/4 text-lg">
                        <p>メンバー数: {{ $maker->number_of_people }}人</p>
                        <p>グループ数: {{ count($maker->groups) }}グループ</p>
                        <form action="/groups/{{ $maker->id }}" method="POST" id="delete_{{ $maker->id }}">
                            @csrf
                            @method("DELETE")
                            <button type="button" onclick="deleteGroup({{ $maker->id }})" class="w-20 mt-6 py-2 px-3 text-sm font-semibold text-center text-white bg-red-400 rounded-lg hover:bg-red-500">
                                削除
                            </button>
                        </form>
                    </div>
                    
                    <table class="w-3/4 table-fixed text-center">
                        <thead>
                            <tr class="bg-gray-300 w-1/2">
                                <th>グループ名</th>
                                <th>メンバー</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maker->groups as $group)
                            <tr class="border-t border-gray-300 w-1/2">
                                <td>{{ $group->name }}</td>
                                <td>
                                    @foreach ($group->members as $member)
                                        <p>{{ $member->name }}</p>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
        </div>
    </div>

    <script>
        function deleteGroup(id) {
            "use strict"

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`delete_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
