@extends('templates.full')

@section('main')
            <header class="flex items-center justify-between border-b border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
                <h1 class="text-2xl font-semibold leading-10 text-white">CHAT</h1>
            </header>
            
            <div class="container ml-8 mt-4">
                <h1 class="text-2xl font-semibold my-4 text-white"><strong>Chat with:</strong> {{ '@' . $chat_with->username }}</h1>
                <ul class="space-y-4 mt-2">
                    @foreach ($messages as $message)
                        <li>
                            <div style="{{ $message->sender_id === Auth::user()->id ? 'text-align: end;' : 'text-align: start;' }}">
                                <div class="w-full mx-auto rounded-lg text-white">
                                    <div>
                                        Sent: {{ $message->created_at }}
                                    </div>
                                    {{ $message->message }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="my-4 mt-8">
                    <!-- Send Message Form -->
                    <form action="{{ route('send_message', [$chat_with->id]) }}" method="post" class="flex items-center">
                        @csrf

                        <input type="text" name="message" class="w-full py-2 px-4 rounded-l border border-gray-300 focus:outline-none" placeholder="Type your message...">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-r hover:bg-blue-600">Send</button>
                    </form>
                </div>
            </div>
@endsection