<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Role Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h1 class="text-xl pb-4"><b>User List</b></h1>
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

                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">User Type</th>
                                <th class="px-4 py-2">Controls</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($users->isNotEmpty())
                            @foreach ($users as $user)

                            <tr>
                                <td class="border px-4 py-2">{{$user->id}}</td>
                                <td class="border px-4 py-2">{{$user->name}}</td>
                                <form action="{{route('superadmin/update', $user->id)}}" method="post">

                                    @csrf
                                    @method('PUT')
    
                                    <td class="border px-4 py-2">
                                        <select name="usertype" id="usertype" required>
                                            <option value="admin" {{$user->usertype == 'admin'? 'selected' : ''}}>admin</option>
                                            <option value="superadmin" {{$user->usertype == 'superadmin'? 'selected' : ''}}>superadmin</option>
                                            <option value="user" {{$user->usertype == 'user'? 'selected' : ''}}>user</option>
                                        </select>
                                    </td>
    
                                    <td class="border px-4 py-2">
                                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Save Changes</button>
                                        <a onclick="return confirm('Are you sure you want to delete this record?')" href="{{route('superadmin/delete', $user->id)}}"><button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                                        </a>
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