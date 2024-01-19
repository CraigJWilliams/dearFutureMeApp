<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendMessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'date_to_be_sent' => 'required|date',
        ]);

        $message = new Message;
        $message->message = $request->message;
        $message->date_to_be_sent = $request->date_to_be_sent;
        $message->user_id = auth()->id(); // Assuming the user is authenticated
        // Log::debug($message);
        // dd($message);
        $message->save();

        

        $formattedDate = Carbon::parse($request->date_to_be_sent)->format('j F Y');

        // Redirect to the 'message-sent' route with the formatted date
        return redirect()->route('message-sent')->with('dateToBeSent', $formattedDate);
            }
}
