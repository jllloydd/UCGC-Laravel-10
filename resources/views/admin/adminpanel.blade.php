<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-b from-emerald-900 via-emerald-600 to-emerald-900 dark:bg-gray-800 overflow-hidden p-4 shadow-lg sm:rounded-lg">

                <div class="flex justify-between items-center px-5 mb-5">
                    @foreach($admininfo as $info)
                    <h1 class="text-3xl font-bold text-white">Hi, {{$info->name}}!</h1>
                    @endforeach

                    <!-- Add the Complete Counselor Profile button here -->
                    @if(!Auth::user()->counselorInfo()->exists())
                    <button type="button" class="bg-white hover:bg-emerald-400 text-dark font-bold py-2 px-4 rounded" onclick="openCounselorProfileModal()">
                        Complete Counselor Profile
                    </button>
                    @endif
                </div>

                <div class="flex-column grid grid-cols-1 gap-6">{{-- cards and tables grid --}}
                    
                    <div class="flex-grid grid grid-cols-4"> {{-- info cards --}}

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/pending.svg')}}" alt="Pending Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Pending Appointments</h3>
                            <p class="text-3xl font-bold" id="pendingappointments">{{$pendingappointments}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/activeappointment.png')}}" alt="Hourglass Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Active Appointments</h3>
                            <p class="text-3xl font-bold" id="activeappointments">{{$activeappointments}}</p>

                        </div>
                         
                        <div class="bg-white text-dark p-4 m-5 shadow-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300 rounded-lg">
                            
                            <img src="{{asset('assets/images/usersicon.png')}}" alt="Users Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Completed Appointments</h3>
                            <p class="text-3xl font-bold" id="completedcount">{{$completedcount}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-50 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/appointments.png')}}" alt="Appointments Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">All Appointments</h3>
                            <p class="text-3xl font-bold" id="appointmentcount">{{$appointmentcount}}</p>

                        </div>
                        
                    </div>

                    @if($upcomingappointments->isNotEmpty())

                    <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg"> {{-- upcoming appointments for admin --}}

                        @if (session('status'))
                        <script>
                            toastr.success('Appointment details edited successfully!', {
                                timeOut:2000
                            });
                        </script>
                        @endif

                       <h1 class="text-3xl font-extrabold mb-5">
                        <span>Your Upcoming Appointments</span>
                       </h1>

                       <div id="dynamic-content-area" class="flex flex-row justify-center items-center">

                       <table id="upcoming-appointments-table" class="text-dark w-full text-sm text-left rtl:text-right text-gray-900 dark:text-gray-400">

                        <thead class="text-md text-white uppercase bg-emerald-900 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4">Name</th>
                                <th class="px-1 py-4">@sortablelink('course')</th>
                                <th class="px-2 py-4">@sortablelink('mode')</th>
                                <th class="px-6 py-4">@sortablelink('date')</th>
                                <th class="px-6 py-4">@sortablelink('time')</th>
                                <th class="px-6 py-4">Meeting Link / Room Name</th>
                                <th class="py-4"></th>
                                <th class="py-4"></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($upcomingappointments as $appinfo)
                            @if ($appinfo->status == 'Active')

                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$appinfo->name}}</td>
                                <td class="px-2 py-4">{{$appinfo->course}}</td>
                                <td class="px-2 py-4">{{$appinfo->mode}}</td>
                                <td class="px-6 py-4">{{$appinfo->date}}</td>
                                <td class="px-6 py-4">{{ date('h:i A', strtotime($appinfo->time)) }}</td>
                                <td class="px-6 py-4">{{$appinfo->room}}</td>
                                <td class="py-4">

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

                                <td class="py-4">

                                    <form action="{{route('admin/panel/complete', $appinfo->id)}}" method="post">

                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" onclick="return confirm('Set appointment as complete?')" class="text-whitehover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            <img src="{{asset('assets/images/complete.png')}}" alt="Edit Button Icon" class="h-auto max-h-8 max-w-8 w-auto">
                                        </button>
                                    </form>

                                </td>

                            </tr>
                            @endif
                            @endforeach
                            
                        </tbody>


                       </table>

                    </div>

                       <div id="pagination-container" class="mt-4 bg-none">{!! $upcomingappointments->appends(\Request::except('page'))->render() !!}</div>

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

    <script> //AJAX Polling script, ensures that data within the admin panel is updated relative to the database changes.
        function fetchData() {
            $.ajax({
                url: "{{ route('admin/panel') }}",
                type: "GET",
                success: function(data) {
                    $('#completedcount').text(data.completedcount);
                    $('#appointmentcount').text(data.appointmentcount);
                    $('#activeappointments').text(data.activeappointments);
                    $('#pendingappointments').text(data.pendingappointments);
                },
                error: function() {
                    console.log("Error fetching data.");
                }
            });
        }
    
        // Poll every 10 seconds
        setInterval(fetchData, 10000);
    </script>

<div id="counselorProfileModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Complete Counselor Profile
                </h3>
                <div class="mt-2">
                    <form id="counselorProfileForm">
                        @csrf
                        <div class="mb-4">
                            <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                            <select id="gender" name="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Department</label>
                            <input type="text" id="department" name="department" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="expertise" class="block text-gray-700 text-sm font-bold mb-2">Area of Expertise</label>
                            <input type="text" id="expertise" name="expertise" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="submitCounselorProfile()">
                    Save Profile
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeCounselorProfileModal()">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitCounselorProfile() {
        const form = document.getElementById('counselorProfileForm');
        const formData = new FormData(form);
    
        fetch('{{ route('admin.counselor.profile.update') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if(data.success) {
                alert('Profile updated successfully!');
                closeCounselorProfileModal();
                location.reload();
            } else {
                alert(data.message || 'Error updating profile. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
    
    function openCounselorProfileModal() {
        document.getElementById('counselorProfileModal').classList.remove('hidden');
    }
    
    function closeCounselorProfileModal() {
        document.getElementById('counselorProfileModal').classList.add('hidden');
    }
    </script>

</x-app-layout>