@extends('templates.full')

@section('main')
            <header class="flex items-center justify-between border-b border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
                <h1 class="text-2xl font-semibold leading-10 text-white">HOME</h1>
            </header>

            <div class="text-white pb-20 ml-6 mt-8">
                <div class="container mx-auto text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="GameHive Logo" class="h-16 mx-auto mb-4">
                    <h1 class="text-4xl font-extrabold mb-4">Welcome to GameHive</h1>
                    <p class="text-lg mb-8">Share your gamer usernames, connect with gamers, and play together.</p>
                    <a href="{{ route('profile') }}" class="bg-green-500 text-white py-2 px-6 rounded-full font-medium text-lg hover:bg-green-600">Edit your account!</a>
                </div>
            </div>

            <div class="container ml-4 text-white">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <h2 class="text-2xl font-semibold my-4">Connect with Gamers</h2>
                        <p class="text-gray-400">Find and chat with fellow gamers who share your interests.</p>
                    </div>

                    <div class="text-center">
                        <h2 class="text-2xl font-semibold my-4">Share Your Games</h2>
                        <p class="text-gray-400">List the games you play and discover new gaming buddies.</p>
                    </div>

                    <div class="text-center">
                        <h2 class="text-2xl font-semibold my-4">Play and Chat</h2>
                        <p class="text-gray-400">Play games together and chat in real-time with your gaming pals.</p>
                    </div>
                </div>
            </div>
@endsection