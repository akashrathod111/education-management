<?php

namespace App\Jobs;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class SendAnnouncementEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected  $student;
    protected  $params;

    public function __construct($student, $params)
    {
        $this->student = $student;
        $this->params = $params;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {   
        $announcementData = [
            'name' => $this->params['name'],
            'description' => $this->params['description'],
        ];

        Mail::send('emails.announcement', ['announcement' => $announcementData], function (Message $message) {
            if ($this->params['is_send_parent'] == 'on') {
                $message->to($this->student->email)->cc($this->student->parent->email)->subject('Announcement Email');
            }else{
                $message->to($this->student->email)->subject('Announcement Email');
            }
            
        });
    }
}
