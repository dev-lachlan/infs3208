<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $chatPartners = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->selectRaw('CASE
                            WHEN sender_id = ? THEN receiver_id
                            ELSE sender_id
                        END AS chat_partner_id', [$user->id])
            ->distinct()
            ->get();

        $chats = [];
        foreach ($chatPartners as $partner) {
            $latestMessage = Message::where(function ($query) use ($user, $partner) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', $partner->chat_partner_id);
            })->orWhere(function ($query) use ($user, $partner) {
                $query->where('sender_id', $partner->chat_partner_id)
                    ->where('receiver_id', $user->id);
            })->latest()
            ->first();

            $chats[] = [
                'partner' => User::findOrFail($partner->chat_partner_id),
                'latestMessage' => $latestMessage,
            ];
        }

        return view('messages', [
            'path' => $request->path(),
            'username' => Auth::user()->username,
            'chats' => $chats,
        ]);
    }

    public function chat(Request $request, $chat_with)
    {
        $user = User::findOrFail($chat_with);

        $messages = Message::where(function ($query) use ($chat_with) {
            $query->where('sender_id', Auth::user()->id)
                ->where('receiver_id', $chat_with);
            })->orWhere(function ($query) use ($chat_with) {
                $query->where('sender_id', $chat_with)
                    ->where('receiver_id', Auth::user()->id);
            })->orderBy('created_at', 'asc')
            ->get();
        
        if ($messages->isEmpty()) {
            return redirect()->route('messages');
        }

        return view('chat', [
            'path' => $request->path(),
            'username' => Auth::user()->username,
            'chat_with' => $user,
            'messages' => $messages,
        ]);
    }

    public function send_message(Request $request, $send_to)
    {
        $user = User::findOrFail($send_to);

        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $user->id,
            'message' => $request->input('message'),
        ]);

        return redirect()->route('chat', [$user->id]);
    }

    public function create_chat(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'message' => 'required|string|max:255',
        ]);

        $receiver = User::where('username', $request->input('username'))->first();

        Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiver->id,
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Chat created successfully.');
    }
}
