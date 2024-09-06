<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.cdnfonts.com/css/nexa-bold" rel="stylesheet">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @if(Route::has('login'))
        @auth
            @if (Auth::user()->usertype=='admin')
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
            <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />  
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />  
            <script>
               Pusher.logToConsole = true;
              var pusher = new Pusher('c3b42af8142f638da675', {
                cluster: 'ap1'
              });
              var channel = pusher.subscribe('my-channel');
              channel.bind('appointment-submitted', function(data) {
                toastr.info('New Appointment Created!', {
                    timeOut: 5000
                });
              });
            </script>
            @endif
            @endauth
        @endif
    </head>
    <body class="font-sans antialiased">

        <div id="global-loader" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70">
            <div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">
                <div class="wheel"></div>
                <div class="hamster">
                    <div class="hamster__body">
                        <div class="hamster__head">
                            <div class="hamster__ear"></div>
                            <div class="hamster__eye"></div>
                            <div class="hamster__nose"></div>
                        </div>
                        <div class="hamster__limb hamster__limb--fr"></div>
                        <div class="hamster__limb hamster__limb--fl"></div>
                        <div class="hamster__limb hamster__limb--br"></div>
                        <div class="hamster__limb hamster__limb--bl"></div>
                        <div class="hamster__tail"></div>
                    </div>
                </div>
                <div class="spoke"></div>
            </div>
            <style>
            .wheel-and-hamster {
                --dur: 1s;
                position: relative;
                width: 12em;
                height: 12em;
                font-size: 14px;
              }
              
              .wheel,
              .hamster,
              .hamster div,
              .spoke {
                position: absolute;
              }
              
              .wheel,
              .spoke {
                border-radius: 50%;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
              }
              
              .wheel {
                background: radial-gradient(100% 100% at center,hsla(0,0%,60%,0) 47.8%,hsl(0,0%,60%) 48%);
                z-index: 2;
              }
              
              .hamster {
                animation: hamster var(--dur) ease-in-out infinite;
                top: 50%;
                left: calc(50% - 3.5em);
                width: 7em;
                height: 3.75em;
                transform: rotate(4deg) translate(-0.8em,1.85em);
                transform-origin: 50% 0;
                z-index: 1;
              }
              
              .hamster__head {
                animation: hamsterHead var(--dur) ease-in-out infinite;
                background: hsl(30,90%,55%);
                border-radius: 70% 30% 0 100% / 40% 25% 25% 60%;
                box-shadow: 0 -0.25em 0 hsl(30,90%,80%) inset,
                      0.75em -1.55em 0 hsl(30,90%,90%) inset;
                top: 0;
                left: -2em;
                width: 2.75em;
                height: 2.5em;
                transform-origin: 100% 50%;
              }
              
              .hamster__ear {
                animation: hamsterEar var(--dur) ease-in-out infinite;
                background: hsl(0,90%,85%);
                border-radius: 50%;
                box-shadow: -0.25em 0 hsl(30,90%,55%) inset;
                top: -0.25em;
                right: -0.25em;
                width: 0.75em;
                height: 0.75em;
                transform-origin: 50% 75%;
              }
              
              .hamster__eye {
                animation: hamsterEye var(--dur) linear infinite;
                background-color: hsl(0,0%,0%);
                border-radius: 50%;
                top: 0.375em;
                left: 1.25em;
                width: 0.5em;
                height: 0.5em;
              }
              
              .hamster__nose {
                background: hsl(0,90%,75%);
                border-radius: 35% 65% 85% 15% / 70% 50% 50% 30%;
                top: 0.75em;
                left: 0;
                width: 0.2em;
                height: 0.25em;
              }
              
              .hamster__body {
                animation: hamsterBody var(--dur) ease-in-out infinite;
                background: hsl(30,90%,90%);
                border-radius: 50% 30% 50% 30% / 15% 60% 40% 40%;
                box-shadow: 0.1em 0.75em 0 hsl(30,90%,55%) inset,
                      0.15em -0.5em 0 hsl(30,90%,80%) inset;
                top: 0.25em;
                left: 2em;
                width: 4.5em;
                height: 3em;
                transform-origin: 17% 50%;
                transform-style: preserve-3d;
              }
              
              .hamster__limb--fr,
              .hamster__limb--fl {
                clip-path: polygon(0 0,100% 0,70% 80%,60% 100%,0% 100%,40% 80%);
                top: 2em;
                left: 0.5em;
                width: 1em;
                height: 1.5em;
                transform-origin: 50% 0;
              }
              
              .hamster__limb--fr {
                animation: hamsterFRLimb var(--dur) linear infinite;
                background: linear-gradient(hsl(30,90%,80%) 80%,hsl(0,90%,75%) 80%);
                transform: rotate(15deg) translateZ(-1px);
              }
              
              .hamster__limb--fl {
                animation: hamsterFLLimb var(--dur) linear infinite;
                background: linear-gradient(hsl(30,90%,90%) 80%,hsl(0,90%,85%) 80%);
                transform: rotate(15deg);
              }
              
              .hamster__limb--br,
              .hamster__limb--bl {
                border-radius: 0.75em 0.75em 0 0;
                clip-path: polygon(0 0,100% 0,100% 30%,70% 90%,70% 100%,30% 100%,40% 90%,0% 30%);
                top: 1em;
                left: 2.8em;
                width: 1.5em;
                height: 2.5em;
                transform-origin: 50% 30%;
              }
              
              .hamster__limb--br {
                animation: hamsterBRLimb var(--dur) linear infinite;
                background: linear-gradient(hsl(30,90%,80%) 90%,hsl(0,90%,75%) 90%);
                transform: rotate(-25deg) translateZ(-1px);
              }
              
              .hamster__limb--bl {
                animation: hamsterBLLimb var(--dur) linear infinite;
                background: linear-gradient(hsl(30,90%,90%) 90%,hsl(0,90%,85%) 90%);
                transform: rotate(-25deg);
              }
              
              .hamster__tail {
                animation: hamsterTail var(--dur) linear infinite;
                background: hsl(0,90%,85%);
                border-radius: 0.25em 50% 50% 0.25em;
                box-shadow: 0 -0.2em 0 hsl(0,90%,75%) inset;
                top: 1.5em;
                right: -0.5em;
                width: 1em;
                height: 0.5em;
                transform: rotate(30deg) translateZ(-1px);
                transform-origin: 0.25em 0.25em;
              }
              
              .spoke {
                animation: spoke var(--dur) linear infinite;
                background: radial-gradient(100% 100% at center,hsl(0,0%,60%) 4.8%,hsla(0,0%,60%,0) 5%),
                      linear-gradient(hsla(0,0%,55%,0) 46.9%,hsl(0,0%,65%) 47% 52.9%,hsla(0,0%,65%,0) 53%) 50% 50% / 99% 99% no-repeat;
              }
              
              /* Animations */
              @keyframes hamster {
                from, to {
                  transform: rotate(4deg) translate(-0.8em,1.85em);
                }
              
                50% {
                  transform: rotate(0) translate(-0.8em,1.85em);
                }
              }
              
              @keyframes hamsterHead {
                from, 25%, 50%, 75%, to {
                  transform: rotate(0);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(8deg);
                }
              }
              
              @keyframes hamsterEye {
                from, 90%, to {
                  transform: scaleY(1);
                }
              
                95% {
                  transform: scaleY(0);
                }
              }
              
              @keyframes hamsterEar {
                from, 25%, 50%, 75%, to {
                  transform: rotate(0);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(12deg);
                }
              }
              
              @keyframes hamsterBody {
                from, 25%, 50%, 75%, to {
                  transform: rotate(0);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(-2deg);
                }
              }
              
              @keyframes hamsterFRLimb {
                from, 25%, 50%, 75%, to {
                  transform: rotate(50deg) translateZ(-1px);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(-30deg) translateZ(-1px);
                }
              }
              
              @keyframes hamsterFLLimb {
                from, 25%, 50%, 75%, to {
                  transform: rotate(-30deg);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(50deg);
                }
              }
              
              @keyframes hamsterBRLimb {
                from, 25%, 50%, 75%, to {
                  transform: rotate(-60deg) translateZ(-1px);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(20deg) translateZ(-1px);
                }
              }
              
              @keyframes hamsterBLLimb {
                from, 25%, 50%, 75%, to {
                  transform: rotate(20deg);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(-60deg);
                }
              }
              
              @keyframes hamsterTail {
                from, 25%, 50%, 75%, to {
                  transform: rotate(30deg) translateZ(-1px);
                }
              
                12.5%, 37.5%, 62.5%, 87.5% {
                  transform: rotate(10deg) translateZ(-1px);
                }
              }
              
              @keyframes spoke {
                from {
                  transform: rotate(0);
                }
              
                to {
                  transform: rotate(-1turn);
                }
              }</style>
       </div>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loader = document.getElementById('global-loader');
        
                // Show loader
                function showLoader() {
                    loader.classList.remove('hidden');
                }
        
                // Hide loader
                function hideLoader() {
                    loader.classList.add('hidden');
                }
        
                // Intercept all AJAX requests
                let originalFetch = window.fetch;
                window.fetch = function() {
                    showLoader();
                    return originalFetch.apply(this, arguments).then(function(response) {
                        hideLoader();
                        return response;
                    }).catch(function(error) {
                        hideLoader();
                        throw error;
                    });
                };
        
                // Intercept form submissions
                document.addEventListener('submit', function() {
                    showLoader();
                });
        
                // Hide loader when page is fully loaded
                window.addEventListener('load', hideLoader);
        
                // Hide loader when navigating back/forward
                window.addEventListener('pageshow', hideLoader);
            });
        </script>

    </body>
</html>
