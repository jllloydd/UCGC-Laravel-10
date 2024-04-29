<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Appointment Booking') }}
        </h2>
    </x-slot>

    <main class="p-8">
        <div class="bg-white p-8 rounded-lg shadow-lg">

            <h2 class="text-2xl text-black mb-4 font-extrabold">Before making an appointment, please first accomplish these pre-counselling forms provided by the UC Guidance and Counseling Office.</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-emerald-900 text-white p-4 rounded-lg">
                    <h3 class="text-2xl mb-2 font-bold">Counseling Informed Consent Form</h3>
                    <p class="py-4">Please complete this form before proceeding to the next step.</p>
                    <a href="https://forms.office.com/pages/responsepage.aspx?id=xOcVpfeMl0-yO5ZJFkX38J0LtyD20adMg7bAnvMjPUxUMUpUQUFONU5XVk5XR09MVjMzOEhGWDI1Vi4u">
                        <button type="button" class="bg-white text-black font-bold py-2 px-4 rounded-[10px] hover:bg-green-300">
                            Complete Form
                        </button>
                    </a>
                </div>
                <div class="bg-emerald-900 text-white p-4 rounded-lg">
                    <h3 class="text-2xl mb-2 font-bold">Counseling Intake Form</h3>
                    <p class="py-4">Please complete this form before proceeding to the next step.</p>
                    <a href="https://forms.office.com/pages/responsepage.aspx?id=xOcVpfeMl0-yO5ZJFkX38J0LtyD20adMg7bAnvMjPUxUMEs1VE5BSEExQ1JZODAxMVAwUDlaR1U0Ry4u">
                        <button type="button" class="bg-white text-black font-bold py-2 px-4 rounded-[10px] hover:bg-green-300">
                            Complete Form
                        </button>
                    </a>
                </div>
            </div>

            <div class="text-center mt-8">
                @if ($appointmentinfo->isNotEmpty())

                <a href="{{route('checkstatus')}}">

                    <button type="button" class="bg-emerald-900 text-white py-2 mb-3 px-4 rounded-[10px] font-bold text-md hover:bg-emerald-300 hover:text-black">
                    Check Appointment
                    </button>
                
                </a>

                @else

                <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="bg-emerald-900 text-white py-2 mb-3 px-4 rounded-[10px] font-bold text-md hover:bg-emerald-300 hover:text-black">
                    Make Appointment
                </button>

                @endif

            </div>

            
  
  <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Create New Appointment
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form class="p-4 md:p-5 form" action="/createappointment" method="post">
                        @csrf
                        @method('POST')
                        <div class="grid gap-4 mb-4 grid-cols-2">

                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input 
                                type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>

                            <div class="col-span-2">
                                <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course/Track and Year Level</label>
                                <input 
                                type="text" name="course" id="course" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="mode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preferred mode of counsel</label>
                                <select id="mode" name="mode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected="">Select mode</option>
                                    <option value="Video Call">Video Call</option>
                                    <option value="Chat">Chat</option>
                                    <option value="Face-to-Face">Face-to-Face</option>
                                </select>
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preferred counselor gender</label>
                                <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected="">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Any">Any</option>
                                </select>
                            </div>

                            <div class="col-span-2">
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment Date</label>
                                <input 
                                type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment Time</label>
                                <select id="time" name="time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected="">Select time</option>
                                    <option value="7:30">7:30 - 8:30AM</option>
                                    <option value="8:30">8:30 - 9:30AM</option>
                                    <option value="9:30">9:30 - 10:30AM</option>
                                    <option value="10:30">10:30 - 11:30AM</option>
                                    <option value="13:30">1:30 - 2:30PM</option>
                                    <option value="14:30">2:30 - 3:30PM</option>
                                    <option value="15:30">3:30 - 4:30PM</option>
                                    <option value="16:30">4:30 - 5:30PM</option>
                                </select>
                            </div>
                            
                        </div>

                        <button type="submit" class="text-white inline-flex items-center bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Book Appointment
                        </button>

                    </form>



                </div>
            </div>
        </div> 
        
        @if (session('status'))
        <div class="flex items-center py-5 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">{{session('status')}}</span>
            </div>
          </div>
        @endif

        @if(session() -> has('failed'))
        <div class="flex items-center py-5 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">{{session()->get('failed')}}</span>
            </div>
          </div>
        @endif

        </div>
    </main>

</x-app-layout>
