<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Appointment List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))

            <script>
                toastr.success('Appointment set successfully!', {
                    timeOut:2000
                });
            </script>
            
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                
                <div class="p-6 flex flex-row justify-center items-center text-gray-900 dark:text-gray-100">

                            @if($appointments->isNotEmpty())

                            <table class="w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">
                                <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3">Name</th>
                                        <th class="px-2 py-4">@sortablelink('course')</th>
                                        <th class="px-3 py-4">@sortablelink('mode')</th>
                                        <th class="px-3 py-4">@sortablelink('gender', trans('Preferred Counselor Gender'))</th>
                                        <th class="px-3 py-4">@sortablelink('date')</th>
                                        <th class="px-3 py-4">@sortablelink('time')</th>
                                        <th class="px-6 py-3">Meeting Link / Room Name</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>

                            @foreach ($appointments as $appointment)
                            <tr id="tableValues" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appointment->name}}</td>
                                <td class="px-2 py-4">{{$appointment->course}}</td>
                                <td class="px-3 py-4">{{$appointment->mode}}</td>
                                <td class="px-3 py-4">{{$appointment->gender}}</td>
                                <td class="px-3 py-4">{{$appointment->date}}</td>
                                <td class="px-3 py-4">{{ date('h:i A', strtotime($appointment->time)) }}</td>


                                <form action="{{route('admin/update', $appointment->id)}}" method="post">

                                    @csrf
                                    @method('PUT')

                                    <td class="px-6 py-4">
                                        <input type="text" id="room" name="room" value="{{$appointment->room}}">
                                    </td>
    
                                    <td class="px-4 py-2">
                                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            Set Appointment
                                        </button>
                                    </td>
                                    
                                </form>

                            </tr>
                            @endforeach
                            @else
                            <div class="container mx-auto flex flex-col text-center items-center">

                                <h1 class="text-3xl mb-2 font-extrabold">There are currently no appointments made. Sit back and relax!</h1>
                                <img src="{{asset('assets/images/relax.gif')}}" class="rounded-lg shadow-lg my-3" alt="relax gif">

                            </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>