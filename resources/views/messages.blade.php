@extends('templates.full')

@section('main')
            <header class="flex items-center justify-between border-b border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
                <h1 class="text-2xl font-semibold leading-10 text-white">MESSAGES</h1>
                <button id="showPopupButton" class="mt-2 leading-7 text-green-500">+ New Chat</button>
            </header>

            <div class="container ml-8 mt-4">
                <ul class="divide-y divide-gray-800">
                    @forelse ($chats as $chat)
                        <a href="{{ route('chat',[$chat['partner']]) }}">
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-lg leading-6 text-white"><strong>Chat with:</strong> {{ $chat['partner']->username }}</p>
                                    @if ($chat['latestMessage'])
                                        <p class="mt-1 truncate text-xs leading-5 text-gray-400"><strong>Message:</strong> {{ $chat['latestMessage']->message }}</p>
                                    @else
                                    <p class="mt-1 truncate text-xs leading-5 text-gray-400">No messages yet.</p>
                                    @endif
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    @if ($chat['latestMessage'])
                                        <p class="text-sm leading-6 text-white"><strong>Sent:</strong> {{ $chat['latestMessage']->created_at }}</p>
                                    @endif
                                </div>
                            </li>
                        </a>
                        
                    @empty
                        <li class="text-gray-600 text-xl">You have no chats yet.</li>
                    @endforelse
                </ul>
            </div>

            <div id="popupModal" class="fixed inset-0 flex items-center justify-center hidden w-96">
                <div class="modal-content p-4 rounded-md shadow-lg">
                    <!-- Content of the popup -->
                    <h2 class="text-2xl font-semibold mb-4 text-black">NEW CHAT</h2>
                    <form action="{{ route('create-new-chat') }}" method="POST">
                        @csrf

                        <div>
                            <label for="username" class="block text-sm font-medium leading-6 float-left">User</label>
                            <div class="mt-2">
                                <input id="username" name="username" type="text" autocomplete="username" required class="block w-full rounded-md border-0 bg-black/5 py-1.5 shadow-sm ring-1 ring-inset ring-black/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="mt-2" id="searchResults"></div>

                        <div>
                            <label for="message" class="block text-sm font-medium leading-6 float-left">Message:</label>
                            <div class="mt-2">
                                <input id="message" name="message" type="text" autocomplete="message" required class="block w-full rounded-md border-0 bg-black/5 py-1.5 shadow-sm ring-1 ring-inset ring-black/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <p id="closePopupButton" class="mt-4 bg-red-500 text-white p-2 rounded-md">Cancel</p>
                            <button type="submit" class="mt-4 bg-green-500 text-white p-2 rounded-md">Create</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                const showPopupButton = document.getElementById('showPopupButton');
                const closePopupButton = document.getElementById('closePopupButton');
                const popupModal = document.getElementById('popupModal');

                showPopupButton.addEventListener('click', () => {
                    popupModal.style.display = 'flex'; // Show the popup
                });

                closePopupButton.addEventListener('click', () => {
                    popupModal.style.display = 'none'; // Close the popup
                });

                const usernameInput = document.getElementById('username');
                const searchResults = document.getElementById('searchResults');

                usernameInput.addEventListener('input', async (event) => {
                    const searchTerm = event.target.value;

                    try {
                        const response = await fetch(`/search-users/${searchTerm}`);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const users = await response.json();

                        // Clear previous search results
                        searchResults.innerHTML = '';

                        // Display search results
                        users.forEach(user => {
                            const resultItem = document.createElement('div');
                            resultItem.textContent = user.username;
                            searchResults.appendChild(resultItem);
                        });
                    } catch (error) {
                        console.error(error);
                    }
                });
            </script>
@endsection