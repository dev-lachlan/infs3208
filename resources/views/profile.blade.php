@extends('templates.full')

@section('main')
            <header class="flex items-center justify-start border-b border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
                <h1 class="text-2xl font-semibold leading-10 text-white">PROFILE</h1>
                <h2 class="ml-2 mt-1 text-base font-semibold leading-10 text-gray-300">{{ 'for @' . $username }}</h2>
            </header>

            <div class="space-x-4 px-4 py-8 sm:px-6 lg:px-8">
                <h2 class="mt-2 text-base font-semibold leading-7 text-gray-100">About Me</h2>

                <dl class="mt-6 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                    <div class="pt-6 sm:flex">
                        <dd class="mt-1 ml-2 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400" id="about-me">
                                {{ $about_me ? $about_me : 'No about me yet... edit this & write something about yourself!' }}
                            </div>
                            <form id="about-me-edit" style="display: none;" action="{{ route('update-account-about-me') }}" method="POST">
                                @csrf

                                <textarea id="text" name="text" rows="4" cols="80">{{ $about_me ? $about_me : 'Tell us about you...' }}</textarea>
                                <button type="submit" class="font-semibold text-indigo-600 hover:text-indigo-500">Save</button>
                            </form>
                            <button type="button" class="font-semibold text-indigo-600 hover:text-indigo-500" onclick="toggleAboutMeEdit()">Edit</button>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="space-x-4 px-4 py-4 sm:px-6 lg:px-8">
                <h2 class="mt-2 text-base font-semibold leading-7 text-gray-100">Account Usernames</h2>

                <dl class="mt-6 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-300 sm:w-64 sm:flex-none sm:pr-6">PSN</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400" id="psn-username">
                                {{ array_key_exists('PSN', $account_usernames) ? $account_usernames['PSN'] : 'Not set yet' }}
                            </div>
                            <form id="psn-edit" style="display: none;" action="{{ route('update-account-username') }}" method="POST">
                                @csrf

                                <input type="hidden" name="platform" value="PSN" autocomplete="off">
                                <input id="new_username" name="new_username" type="text" autocomplete="new_username" class="rounded-md border border-gray-300 px-2 text-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm sm:leading-5">
                                <button type="submit" class="font-semibold text-indigo-600 hover:text-indigo-500">Save</button>
                            </form>
                            <button type="button" class="font-semibold text-indigo-600 hover:text-indigo-500" onclick="togglePsnEdit()">Update</button>
                        </dd>
                    </div>
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-300 sm:w-64 sm:flex-none sm:pr-6">XBOX</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400" id="xbox-username">
                                {{ array_key_exists('XBOX', $account_usernames) ? $account_usernames['XBOX'] : 'Not set yet' }}
                            </div>
                            <form id="xbox-edit" style="display: none;" action="{{ route('update-account-username') }}" method="POST">
                                @csrf

                                <input type="hidden" name="platform" value="XBOX" autocomplete="off">
                                <input id="new_username" name="new_username" type="text" autocomplete="new_username" class="rounded-md border border-gray-300 px-2 text-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm sm:leading-5">
                                <button type="submit" class="font-semibold text-indigo-600 hover:text-indigo-500">Save</button>
                            </form>
                            <button type="button" class="font-semibold text-indigo-600 hover:text-indigo-500" onclick="toggleXboxEdit()">Update</button>
                        </dd>
                    </div>
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-300 sm:w-64 sm:flex-none sm:pr-6">STEAM</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400" id="steam-username">
                                {{ array_key_exists('STEAM', $account_usernames) ? $account_usernames['STEAM'] : 'Not set yet' }}
                            </div>
                            <form id="steam-edit" style="display: none;" action="{{ route('update-account-username') }}" method="POST">
                                @csrf

                                <input type="hidden" name="platform" value="STEAM" autocomplete="off">
                                <input id="new_username" name="new_username" type="text" autocomplete="new_username" class="rounded-md border border-gray-300 px-2 text-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm sm:leading-5">
                                <button type="submit" class="font-semibold text-indigo-600 hover:text-indigo-500">Save</button>
                            </form>
                            <button type="button" class="font-semibold text-indigo-600 hover:text-indigo-500" onclick="toggleSteamEdit()">Update</button>
                        </dd>
                    </div>
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-300 sm:w-64 sm:flex-none sm:pr-6">DISCORD</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400" id="discord-username">
                                {{ array_key_exists('DISCORD', $account_usernames) ? $account_usernames['DISCORD'] : 'Not set yet' }}
                            </div>
                            <form id="discord-edit" style="display: none;" action="{{ route('update-account-username') }}" method="POST">
                                @csrf

                                <input type="hidden" name="platform" value="DISCORD" autocomplete="off">
                                <input id="new_username" name="new_username" type="text" autocomplete="new_username" class="rounded-md border border-gray-300 px-2 text-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm sm:leading-5">
                                <button type="submit" class="font-semibold text-indigo-600 hover:text-indigo-500">Save</button>
                            </form>
                            <button type="button" class="font-semibold text-indigo-600 hover:text-indigo-500" onclick="toggleDiscordEdit()">Update</button>
                        </dd>
                    </div>
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-300 sm:w-64 sm:flex-none sm:pr-6">BATTLE.NET</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400" id="battlenet-username">
                                {{ array_key_exists('BATTLENET', $account_usernames) ? $account_usernames['BATTLENET'] : 'Not set yet' }}
                            </div>
                            <form id="battlenet-edit" style="display: none;" action="{{ route('update-account-username') }}" method="POST">
                                @csrf

                                <input type="hidden" name="platform" value="BATTLENET" autocomplete="off">
                                <input id="new_username" name="new_username" type="text" autocomplete="new_username" class="rounded-md border border-gray-300 px-2 text-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm sm:leading-5">
                                <button type="submit" class="font-semibold text-indigo-600 hover:text-indigo-500">Save</button>
                            </form>
                            <button type="button" class="font-semibold text-indigo-600 hover:text-indigo-500" onclick="toggleBattleNetEdit()">Update</button>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="space-x-4 px-4 py-8 sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <h2 class="mt-2 text-base font-semibold leading-7 text-gray-100">Account Games</h2>
                    <button id="showPopupButton" class="mt-2 leading-7 text-green-500">+ Add Game</button>
                </div>

                <dl class="mt-6 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                    @forelse ($account_games as $game)

                    <div class="pt-6 sm:flex">
                        <dd class="mt-1 ml-2 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400">{{ $game->name }}</div>
                            <form action="{{ route('remove-account-game') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $game->id }}" autocomplete="off">
                                <button type="submit" class="font-semibold text-red-600 hover:text-red-500">Remove</button>
                            </form>
                        </dd>
                    </div>
                    @empty

                    <div class="pt-6 sm:flex">
                        <dd class="mt-1 ml-2 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-400">No games yet, add one to your profile!</div>
                        </dd>
                    </div>
                    @endforelse

                </dl>
            </div>

            <div id="popupModal" class="fixed inset-0 flex items-center justify-center hidden w-96">
                <div class="modal-content p-4 rounded-md shadow-lg">
                    <!-- Content of the popup -->
                    <h2 class="text-2xl font-semibold mb-4 text-black">Add a Game!</h2>
                    <form action="{{ route('add-account-game') }}" method="POST">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 float-left">Name:</label>
                            <div class="mt-2">
                                <input id="name" name="name" type="text" autocomplete="name" required class="block w-full rounded-md border-0 bg-black/5 py-1.5 shadow-sm ring-1 ring-inset ring-black/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button id="closePopupButton" class="mt-4 bg-red-500 text-white p-2 rounded-md">Cancel</button>
                            <button type="submit" class="mt-4 bg-green-500 text-white p-2 rounded-md">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <script>
                function toggleAboutMeEdit() {
                    document.getElementById('about-me').style.display = 'none';
                    document.getElementById('about-me-edit').style.display = 'block';
                }
                function togglePsnEdit() {
                    document.getElementById('psn-username').style.display = 'none';
                    document.getElementById('psn-edit').style.display = 'block';
                }
                function toggleXboxEdit() {
                    document.getElementById('xbox-username').style.display = 'none';
                    document.getElementById('xbox-edit').style.display = 'block';
                }
                function toggleSteamEdit() {
                    document.getElementById('steam-username').style.display = 'none';
                    document.getElementById('steam-edit').style.display = 'block';
                }
                function toggleDiscordEdit() {
                    document.getElementById('discord-username').style.display = 'none';
                    document.getElementById('discord-edit').style.display = 'block';
                }
                function toggleBattleNetEdit() {
                    document.getElementById('battlenet-username').style.display = 'none';
                    document.getElementById('battlenet-edit').style.display = 'block';
                }

                const showPopupButton = document.getElementById('showPopupButton');
                const closePopupButton = document.getElementById('closePopupButton');
                const popupModal = document.getElementById('popupModal');

                showPopupButton.addEventListener('click', () => {
                    popupModal.style.display = 'flex'; // Show the popup
                });

                closePopupButton.addEventListener('click', () => {
                    popupModal.style.display = 'none'; // Close the popup
                });
            </script>
@endsection