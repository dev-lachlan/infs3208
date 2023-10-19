@extends('templates.basic')

@section('content')
    <div class="fixed inset-y-0 z-50 flex w-72 flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-black/10 px-6 ring-1 ring-white/5">
            <div class="flex h-16 shrink-0 items-center">
                <img class="mt-4 h-14 w-auto" src="{{ asset('images/logo.png') }}" alt="GameHive">
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li>
                                <!-- Current: "bg-gray-800 text-white", Default: "text-gray-400 hover:text-white hover:bg-gray-800" -->
                                <a href="{{ route('home') }}" class="{{ $path === 'home' ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                <img class="h-6 w-auto" src="{{ asset('images/home.png') }}" alt="GameHive">
                                Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile') }}" class="{{ $path === 'profile' ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                <img class="h-6 w-auto" src="{{ asset('images/profile.png') }}" alt="GameHive">
                                Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('messages') }}" class="{{ $path === 'messages' ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                <img class="h-6 w-auto" src="{{ asset('images/messages.png') }}" alt="GameHive">
                                Messages
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="-mx-6 mt-auto mb-4">
                        <a href="{{ route('settings') }}" class="flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-white hover:bg-gray-800">
                            <img class="h-8 w-8" src="{{ asset('images/settings.png') }}" alt="">
                            <span class="sr-only">Profile Settings</span>
                            <span aria-hidden="true">Account Settings</span>
                        </a>
                        <form action="{{ route('logout') }}" method="post" class="cursor-pointer flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-white hover:bg-gray-800">
                            @csrf
                            
                            <img class="h-8 w-8" src="{{ asset('images/logout.png') }}" alt="">
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="pl-72">
        <main class="mt-10 xl:pr-72">
@yield('main')
        </main>
    </div>
@endsection