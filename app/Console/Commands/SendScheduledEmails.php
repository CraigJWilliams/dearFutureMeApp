<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class SendScheduledEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the messages that have todays date as the day to send and then send emails to the user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->startOfDay();
    
        $messages = Message::whereDate('date_to_be_sent', $today)->get();
    
        foreach ($messages as $message) {
            $user = User::find($message->user_id);
    
            if ($user) {
                Mail::send('mail.send-email-template', ['message' => $message], function ($mail) use ($user) {
                    $mail->to($user->email)->subject('DearFutureMe - A Message From Your Past Self');
                    echo "mail sent to $user->email ";
                });
            }
        }
    }
    
}
