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
                <h1 class="text-3xl font-bold text-white m-5">Hi, {{$info->name}}! Welcome to your dashboard!</h1>
                @endforeach

                <div class="flex-column grid grid-cols-1 gap-6">{{-- cards and tables grid --}}
                    
                    <div class="flex-grid grid grid-cols-4"> {{-- info cards --}}
                         
                        <div class="bg-white text-dark p-4 m-5 shadow-lg transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 rounded-lg">
                            
                            <img src="{{asset('assets/images/usersicon.png')}}" alt="Users Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Total Users</h3>
                            <p class="text-3xl font-bold">{{$usercount}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/appointments.png')}}" alt="Appointments Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Appointments Made</h3>
                            <p class="text-3xl font-bold">{{$appointmentcount}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/activeappointment.png')}}" alt="Hourglass Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Active Appointments</h3>
                            <p class="text-3xl font-bold">{{$activeappointments}}</p>

                        </div>

                        <div class="bg-white text-dark p-4 m-5 shadow-lg rounded-lg transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                            
                            <img src="{{asset('assets/images/pending.svg')}}" alt="Pending Icon" width="65" height="65" class="mb-2">
                            <h3 class="text-base font-bold">Pending Appointments</h3>
                            <p class="text-3xl font-bold">{{$pendingappointments}}</p>

                        </div>
                        
                    </div>
    
                    <div class=" flex-grid grid grid-cols-2 gap-4">{{-- charts/tables --}}
                        
                        <div class="p-2 m-5 bg-white rounded-lg shadow-lg text-dark transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-105 duration-300">
                            {!! $chart->container() !!}
                        </div>

                        <div class="p-2 m-5 bg-white rounded-lg shadow-lg text-dark transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-105 duration-300">
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