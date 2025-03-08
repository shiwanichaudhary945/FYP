<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ChatsController extends Controller
{
    public function fetchMessages($receiver_id)
    {
        return Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => 'Message sent successfully']);
    }

    public function showChat($receiver_id)
{
    $receiver = User::findOrFail($receiver_id);
    return view('chats.chat', compact('receiver_id', 'receiver'));
}

public function landlordChat($user_id)
{
    $landlord_id = Auth::id(); // Get logged-in landlord's ID

    // Fetch messages between landlord and the user
    $messages = Message::with(['sender', 'receiver'])  // Eager load sender and receiver
        ->where(function ($query) use ($user_id, $landlord_id) {
            $query->where('sender_id', $landlord_id)
                  ->where('receiver_id', $user_id);
        })
        ->orWhere(function ($query) use ($user_id, $landlord_id) {
            $query->where('sender_id', $user_id)
                  ->where('receiver_id', $landlord_id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        $receiver = User::find($user_id); // Ensure receiver exists
        return view('backend.dashboard.landlord', compact('messages', 'receiver'));


}





}
