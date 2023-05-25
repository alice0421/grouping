<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grouping Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 pb-2 text-xl font-bold border-b border-gray-300">用途: {{ $maker->title }}</div>
                <div class="flex flex-row px-6 pt-2 pb-6 text-gray-900">
                    <p class="w-1/3">メンバー数: {{ $maker->number_of_people }}</p>
                    <table class="mx-auto table-fixed w-2/3 text-center">
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
</x-app-layout>
