<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Appointment Status') }}
        </h2>
    </x-slot>

    <main class="p-8">

        <div class="bg-white p-8 rounded-lg shadow-lg"> 
            <div class="bg-emerald-900 text-white p-4 rounded-lg">
                @if($appointmentinfo->isNotEmpty())
                    @foreach ($appointmentinfo as $info)
                    <h1 class="text-3xl mb-2 font-extrabold">Hi {{$info->name}}! Your appointment is currently: {{ $info->status }} </h1>
                        @if($info->status=='Pending')
                        <h1 class="py-4">Please wait for further updates.</h1>
                        {{-- <img src="{{asset('assets/images/pending.gif')}}" class="lg:w-1/3 lg:h-2/5 rounded-lg mb-3 sm:rounded-lg" alt="Pending Animation"> --}}
                        @elseif($info->status=='Active')
                        <p class="py-4 text-xl font-bold">Your appointment is set for <u>{{$info->date}} {{$info->time}}<u></p>
                        @endif
                    <a onclick="return confirm('Are you sure you want to cancel your appointment?')" href="{{route('checkstatus/delete', $info->user_id)}}">
                        <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Cancel Appointment
                        </button>
                    </a>
                    @endforeach
                @else
                    <h1 class="text-3xl mb-2 font-extrabold">You currently have no appointments made.</h1>
                @endif
            </div>

        </div>

    </main>

</x-app-layout>
