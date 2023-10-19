@extends('templates.basic')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-14 w-auto" src="{{ asset('images/logo.png') }}" alt="GameHive">
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-white">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" autocomplete="username" required class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-white">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="password" required class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                    </div>
                </div>

                @error('login_error')
                    <p class="m-0 text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Login</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-400">
                Not a member?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-indigo-400 hover:text-indigo-300">Register Here!</a>
            </p>
        </div>
    </div>
@endsection