<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grouping Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{ group_number: 2 }">
                    <p>作成者: {{ $maker->user->name }}</p>    
                    <p>メンバー数: {{ $maker->number_of_people }}</p>
                    <table class="mx-auto table-auto w-2/3 text-center">
                        <thead>
                            <tr class="bg-gray-300">
                                <th>グループ名</th>
                                <th>メンバー</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maker->groups as $group)
                            <tr class="border-t border-gray-300">
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
