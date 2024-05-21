<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-b from-emerald-900 via-emerald-600 to-emerald-900 dark:bg-gray-800 overflow-hidden p-4 shadow-lg sm:rounded-lg">

                @foreach($admininfo as $info)
                <h1 class="text-3xl font-bold text-white m-5">Hi, {{$info->name}}!</h1>
                @endforeach

                <div class="flex-column grid grid-cols-1 gap-6">{{-- cards and tables grid --}}
                    
                    <div class="flex-grid grid grid-cols-4"> {{-- info cards --}}
                         
                        <div class="bg-white text-dark p-4 m-5 shadow-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300 rounded-lg">
                            
                            <img src="{{asset('assets/images/usersicon.png')}}" alt="Users Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Total Users</h3>
                            <p class="text-3xl font-bold">{{$usercount}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/appointments.png')}}" alt="Appointments Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Appointments Made</h3>
                            <p class="text-3xl font-bold">{{$appointmentcount}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/activeappointment.png')}}" alt="Hourglass Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Active Appointments</h3>
                            <p class="text-3xl font-bold">{{$activeappointments}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/pending.svg')}}" alt="Pending Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Pending Appointments</h3>
                            <p class="text-3xl font-bold">{{$pendingappointments}}</p>

                        </div>
                        
                    </div>

                    @if($upcomingappointments->isNotEmpty())

                    <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg"> {{-- upcoming appointments for admin --}}

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

                       <h1 class="text-3xl font-extrabold mb-5">
                        <span>Your Upcoming Appointments</span>
                       </h1>

                       <div class="flex flex-row justify-center items-center">

                       <table class="text-dark w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">

                        <thead class="text-md text-white uppercase bg-emerald-900 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4">Name</th>
                                <th class="px-1 py-4">@sortablelink('course')</th>
                                <th class="px-2 py-4">@sortablelink('mode')</th>
                                <th class="px-6 py-4">@sortablelink('date')</th>
                                <th class="px-6 py-4">@sortablelink('time')</th>
                                <th class="px-6 py-4">Meeting Link / Room Name</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($upcomingappointments as $appinfo)

                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appinfo->name}}</td>
                                <td class="px-2 py-4">{{$appinfo->course}}</td>
                                <td class="px-2 py-4">{{$appinfo->mode}}</td>
                                <td class="px-6 py-4">{{$appinfo->date}}</td>
                                <td class="px-6 py-4">{{$appinfo->time}}</td>
                                <td class="px-6 py-4">{{$appinfo->room}}</td>
                                <td class="px-6 py-2">

                                    <button type="submit" data-modal-target="crud-modal{{$appinfo->id}}" data-modal-toggle="crud-modal{{$appinfo->id}}" class="text-whitehover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <img src="{{asset('assets/images/edit-button.png')}}" alt="Edit Button Icon" class="h-auto max-h-8 max-w-8 w-auto">
                                    </button>

                                    <div id="crud-modal{{$appinfo->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Edit Appointment Details
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal{{$appinfo->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <form class="p-4 md:p-5 form" action="{{route('admin/panel/edit', $appinfo->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                            
                                                        <div class="col-span-2">
                                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meeting Link / Room Name</label>
                                                            <input 
                                                            type="text" name="room" id="room" value="{{$appinfo->room}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                                                        </div>
                            
                                                        <div class="col-span-2">
                                                            <label for="appointed_counselor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointed Counselor</label>
                                                            <select id="appointed_counselor" name="appointed_counselor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                <option value="{{$appinfo->appointed_counselor}}">{{$appinfo->appointed_counselor}}</option>
                                                                @foreach($adminNameList as $alladmin)
                                                                <option value="{{$alladmin->name}}">{{$alladmin->name}}</option>   
                                                                @endforeach
                                                                
                                                            </select>
                                                        </div>

                                                        <div class="col-span-2">

                                                            <button type="submit" class="text-white inline-flex items-center bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                                Save Changes
                                                            </button>

                                                        </div>
                            

                            
                                                </form>
                            
                            
                            
                                            </div>
                                        </div>
                                    </div> 

                                </td>

                            </tr>

                            @endforeach
                            
                        </tbody>


                       </table>

                    </div>

                       <div class="mt-4 bg-none">{!! $upcomingappointments->appends(\Request::except('page'))->render() !!}</div>

                    </div>
                    @endif
    
                    <div class=" flex-grid grid grid-cols-2 gap-4">{{-- charts/tables --}}
                        
                        <div class="p-2 m-5 bg-white rounded-lg shadow-lg text-dark transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-105 duration-300">
                            {!! $chart->container() !!}
                        </div>

                        <div class="p-2 m-5 bg-white rounded-lg shadow-lg text-dark transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-105 duration-300">
                            {!! $barchart->container() !!}
                        </div>
                        

                    </div>

                    <script src="{{ $chart->cdn() }}"></script>
                    {{ $chart->script() }}
                    <script src="{{ $barchart->cdn() }}"></script>
                    {{ $barchart->script() }}

                </div>

            </div>

        </div>
    </div>
</x-app-layout>