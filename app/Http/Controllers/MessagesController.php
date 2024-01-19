<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Message;


class MessagesController extends Controller
{
    public function index()
{
    $messages = collect();
    $nextDueMessageInfo = ''; 

    if (Auth::check()) {
        $user = Auth::user();
        $totalMessages = $user->messages()->count();
        $dueMessages = $user->messages()->where('date_to_be_sent', '<=', Carbon::now())->get();

        $nextDueMessage = $user->messages()->where('date_to_be_sent', '>', Carbon::now())->orderBy('date_to_be_sent', 'asc')->first();
        if ($nextDueMessage) {
            $nextDueDate = $nextDueMessage->date_to_be_sent->format('F j, Y');
            $nextDueMessageInfo = "Your next message is due on " . $nextDueDate . ".";
        } else {
            $nextDueMessageInfo = "You have no scheduled messages.";
        }

        if ($totalMessages == 0) {
            $displayMessage = "It looks like you haven't created any messages yet!";
        } elseif ($dueMessages->isEmpty() && !$nextDueMessage) {
            $displayMessage = "You have no messages scheduled for the future.";
        } else {
            $messages = $dueMessages;
        }
    }

    return view('dashboard', [
        'messages' => $messages,
        'displayMessage' => $displayMessage ?? '',
        'nextDueMessageInfo' => $nextDueMessageInfo 
    ]);
}

    
    public function destroy($id)
{
    $message = Message::findOrFail($id);
  

    $message->delete();

    return back()->with('success', 'Message deleted successfully.');
}
}
