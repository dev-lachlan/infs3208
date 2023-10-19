@extends('templates.full')

@section('main')
            <header class="flex items-center justify-between border-b border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
                <h1 class="text-2xl font-semibold leading-10 text-white">ACCOUNT SETTINGS</h1>
            </header>
    
            <div class="divide-y divide-white/5">
                <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-8 sm:px-6 md:grid-cols-3 lg:px-8">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-white">Personal Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-400">Use a permanent address where you can receive mail.</p>
                    </div>

                    <form action="{{ route('update-username') }}" method="POST" class="md:col-span-2">
                        @csrf

                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">

                            <div class="col-span-full">
                                <label for="username" class="block text-sm font-medium leading-6 text-white">Username</label>
                                <div class="mt-2">
                                    <input id="username" name="username" type="text" autocomplete="username" placeholder="{{ $username }}" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                                </div>
                                @error('username')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-8 flex">
                            <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                        </div>
                        @if(session('username_success'))
                            <div class="text-green-500">
                                {{ session('username_success') }}
                            </div>
                        @endif
                    </form>
                </div>

                <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-8 sm:px-6 md:grid-cols-3 lg:px-8">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-white">Change password</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-400">Update your password associated with your account.</p>
                    </div>

                    <form action="{{ route('update-password') }}" method="POST" class="md:col-span-2">
                        @csrf

                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="current-password" class="block text-sm font-medium leading-6 text-white">Current password</label>
                            <div class="mt-2">
                            <input id="current-password" name="current_password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            </div>
                            @error('current_password')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <label for="new-password" class="block text-sm font-medium leading-6 text-white">New password</label>
                            <div class="mt-2">
                            <input id="new-password" name="new_password" type="password" autocomplete="new-password" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            </div>
                            @error('new_password')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        </div>

                        <div class="mt-8 flex">
                        <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                        </div>
                        @if(session('password_success'))
                            <div class="text-green-500">
                                {{ session('password_success') }}
                            </div>
                        @endif
                    </form>
                </div>

                <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-10 px-4 py-8 sm:px-6 md:grid-cols-3 lg:px-8">
                    <div>
                        <h2 class="text-base font-semibold leading-7 text-white">Delete account</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-400">No longer want to use our service? You can delete your account here. This action is not reversible. All information related to this account will be deleted permanently.</p>
                    </div>

                    <form action="{{ route('delete-user') }}" method="POST" class="flex items-start md:col-span-2">
                        @csrf
                        
                        <button type="submit" class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400">Yes, delete my account</button>
                    </form>
                </div>
            </div>
@endsection