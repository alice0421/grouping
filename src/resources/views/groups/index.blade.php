<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="mx-auto table-auto w-3/4 text-center">
                        <thead>
                            <tr class="bg-gray-300">
                                <th></th>
                                <th>用途</th>
                                <th>グループ数</th>
                                <th>人数</th>
                                <th>作成日時</th>
                            </tr>
                            <tbody>
                            @foreach ($makers as $maker)
                                <tr class="border-t border-gray-300">
                                    <td>
                                        <form action="/groups/{{ $maker->id }}" method="POST" id="delete_{{ $maker->id }}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="button" onclick="deleteGroup({{ $maker->id }})" class="my-2 py-2 px-3 text-sm font-semibold text-center text-white bg-red-400 rounded-lg hover:bg-red-500">
                                                削除
                                            </button>
                                        </form>
                                    </td>
                                    <td><a href="/groups/{{ $maker->id }}" class="text-blue-700 underline hover:no-underline">{{ $maker->title }}</a></td>
                                    <td>{{ count($maker->groups) }}</td>
                                    <td>{{ $maker->number_of_people }}</td>
                                    <td>{{ $maker->updated_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </thead>
                    </table>
                </div>
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
