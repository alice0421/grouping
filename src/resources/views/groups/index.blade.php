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
                                <th>用途</th>
                                <th>グループ数</th>
                                <th>人数</th>
                                <th>作成日時</th>
                            </tr>
                            <tbody>
                            @foreach ($makers as $maker)
                                <tr class="border-t border-gray-300">
                                    <td>{{ $maker->title }}</td>
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
</x-app-layout>
