<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Counselor List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 flex flex-row justify-center items-center text-gray-900 dark:text-gray-100">

                    @if($admininfo->isNotEmpty())

                    <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                        <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Gender</th>
                                <th class="px-6 py-3">Department</th>
                                <th class="px-6 py-3">Expertise</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($admininfo as $info)
                        <tr id="tableValues" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center">
                                <span class="inline-block w-3 h-3 rounded-full mr-2 {{ $info->active_status == 1 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{$info->name}}
                            </td>
                            <td class="px-6 py-4">{{ $info->gender ?? 'Not set' }}</td>
                            <td class="px-6 py-4">{{ $info->department ?? 'Not set' }}</td>
                            <td class="px-6 py-4">{{ $info->expertise ?? 'Not set' }}</td>
                        </tr>
                        @endforeach
                    @else
                    <div class="container mx-auto flex flex-col text-center items-center">

                        <h1 class="text-3xl mb-2 font-extrabold">There are currently no admins.</h1>
                    </div>
                    @endif
                </tbody>
            </table>

                </div>  
            </div>
        </div>
    </div>
</x-app-layout>