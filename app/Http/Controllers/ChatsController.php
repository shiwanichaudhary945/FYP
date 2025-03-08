<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

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

        return response()->json($message);
    }
}
