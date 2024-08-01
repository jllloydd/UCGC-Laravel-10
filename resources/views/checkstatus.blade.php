<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
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
                        <p class="py-4 text-xl font-bold">Your appointment is set for the date<span class="text-4xl px-2">{{$info->date}}, {{ date('h:i A', strtotime($info->time)) }}</span></p>
                            @if ($info->mode=='Video Call')
                            <p class="py-4 text-xl font-bold">
                                
                                Your appointed counselor is {{$info->appointed_counselor}}. Please join the meeting on or before your set date at <a href="{{$info->room}}" target="_blank" data-tooltip-target="link-tooltip" class="hover:text-gray-600">{{$info->room}}</a>

                                <div id="link-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Go to meeting page
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                            </p>
                            @elseif($info->mode=='Chat')
                            <p class="py-4 text-xl font-bold">
                                Your appointed counselor is {{$info->appointed_counselor}}. Please go find them in the chat room on or before your set date.
                            </p>
                            @elseif($info->mode=='Face-to-Face')
                            <p class="py-4 text-xl font-bold">
                                Your appointed counselor is {{$info->appointed_counselor}}. Please go to the room S217 on or before your set date.
                            </p>
                            @endif
                        @elseif($info->status=='Completed')
                        <p class="py-4 text-xl font-bold">You have completed your appointment. If you haven't done so, please accomplish the Counseling Evaluation Form by clicking the link <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=xOcVpfeMl0-yO5ZJFkX38J0LtyD20adMg7bAnvMjPUxURjNSMzBHMVgxV0dVVjUwM0JYNUtVM1NHVC4u"><u>here</u></a>. Click the link below to schedule another appointment.</p>
                        @endif

                    <a onclick="return confirm('Are you sure you want to delete your appointment?')" href="{{route('checkstatus/delete', $info->user_id)}}">
                        @if($info->status =='Completed')
                        <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Schedule New Appointment
                        </button>
                        @else
                        <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Cancel Appointment
                        </button>
                        @endif
                    </a>
                    @endforeach
                @else
                    <h1 class="text-3xl mb-2 font-extrabold">You currently have no appointments made.</h1>
                @endif
            </div>

        </div>

    </main>

</x-app-layout>
