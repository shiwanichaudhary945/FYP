<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatsController extends Controller
{
    // Fetch messages between the user and the receiver
    public function fetchMessages($receiver_id)
    {
        return Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();
    }

    // Send message to the landlord
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        // Check if the user is a normal user (role_id == 1)
        if ($user->role_id == 1) {
            // Get the landlord (role_id == 3)
            $landlord = User::where('role_id', 3)->first(); // Assuming only one landlord

            if ($landlord) {
                $message = Message::create([
                    'sender_id' => Auth::id(),
                    'receiver_id' => $landlord->id, // Send to landlord
                    'message' => $request->message,
                ]);

                broadcast(new MessageSent($message))->toOthers();

                return response()->json(['message' => 'Message sent to the landlord successfully']);
            } else {
                return response()->json(['error' => 'No landlord found'], 404);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Show the chat for a specific user
    public function showChat($receiver_id)
    {
        $receiver = User::findOrFail($receiver_id);
        return view('chats.chat', compact('receiver_id', 'receiver'));
    }

    // Landlord chat view - Show messages between landlord and user
    public function landlordChat($user_id)
    {
        $landlord_id = Auth::id(); // Get logged-in landlord's ID

        // Fetch messages between landlord and the user
        $messages = Message::with(['sender', 'receiver']) // Eager load sender and receiver
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

    public function landlordMessages()
{
    $landlord_id = Auth::id(); // Get the logged-in landlord's ID

    // Fetch messages where the logged-in user is the receiver (landlord)
    $messages = Message::with(['sender', 'receiver'])  // Eager load sender and receiver
        ->where('receiver_id', $landlord_id)
        ->orderBy('created_at', 'desc')  // Sort by created_at to get the latest messages first
        ->get();

    return view('backend.dashboard.landlord', compact('messages'));
}

}
