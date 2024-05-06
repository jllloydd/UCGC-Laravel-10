<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Appointment List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">{{session('status')}}</span>
                </div>
              </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <table class="w-full table-auto">
                        <thead class=>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Course</th>
                                <th class="px-4 py-2">Counseling Mode</th>
                                <th class="px-4 py-2">Preferred Counselor Gender</th>
                                <th class="px-4 py-2">Appointment Date</th>
                                <th class="px-4 py-2">Reserved Time</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Room</th>
                                <th class="px-4 py-2">Controls</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($appointments->isNotEmpty())
                            @foreach ($appointments as $appointment)
                            <tr>
                                <td class="border px-4 py-2">{{$appointment->name}}</td>
                                <td class="border px-4 py-2">{{$appointment->course}}</td>
                                <td class="border px-4 py-2">{{$appointment->mode}}</td>
                                <td class="border px-4 py-2">{{$appointment->gender}}</td>
                                <td class="border px-4 py-2">{{$appointment->date}}</td>
                                <td class="border px-4 py-2">{{$appointment->time}}</td>


                                <form action="{{route('admin/update', $appointment->id)}}" method="post">

                                    @csrf
                                    @method('PUT')
    
                                    <td class="border px-4 py-2">
                                        <select name="status" id="status" required>
                                            <option value="Pending" {{$appointment->status == 'Pending'? 'selected' : ''}}>Pending</option>
                                            <option value="Active" {{$appointment->status == 'Active'? 'selected' : ''}}>Active</option>
                                        </select>
                                    </td>

                                    <td class="border px-4 py-2">
                                        <input type="text" id="room" name="room" value="{{$appointment->room}}">
                                    </td>
    
                                    <td class="px-4 py-2">
                                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save Changes</button>
                                    </td>
                                    
                                </form>

                            </tr>

                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>