@extends('templates.full')

@section('main')
            <header class="flex items-center justify-between border-b border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
                <div>
                    <h2 class="mt-1 text-base font-semibold leading-10 text-gray-300"><strong>Profile:</strong> {{ '@' . $user->username }}</h2>
                </div>
            </header>

            <div class="ml-8 mt-8 text-white">
                <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                    <div>
                        <p class="mt-1 text-sm leading-6 text-gray-300">{{ $about_me ? 'About me: ' . $about_me->text : 'This user has no about me yet!' }}</p>

                        <h2 class="mt-10 text-base font-semibold leading-7 text-gray-300">Gamer Usernames:</h2>
                        <dl class="mt-4 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                            @forelse ($gamer_usernames as $guname)
                                <div class="pt-6 sm:flex">
                                    <dt class="font-medium text-gray-300 sm:w-64 sm:flex-none sm:pr-6">{{ $guname->platform }}</dt>
                                    <dd class="flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <div class="text-gray-400">{{ $guname->username }}</div>
                                    </dd>
                                </div>
                            @empty
                                <div class="pt-6 sm:flex">
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <div class="text-gray-400">This user has no gamer usernames yet!</div>
                                    </dd>
                                </div>
                            @endforelse
                        </dl>

                        <h2 class="mt-10 text-base font-semibold leading-7 text-gray-300">Users Listed Games:</h2>
                        <dl class="mt-4 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                            @forelse ($games as $game)
                                <div class="pt-6 sm:flex">
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <div class="text-gray-300">{{ $game->name }}</div>
                                    </dd>
                                </div>
                            @empty
                                <div class="pt-6 sm:flex">
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <div class="text-gray-400">This user has no listed games yet!</div>
                                    </dd>
                                </div>
                            @endforelse
                        </dl>
                    </div>
                </div>
            </div>
@endsection