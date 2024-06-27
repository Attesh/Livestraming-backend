<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reminderNumber;

    public function __construct($user, $reminderNumber)
    {
        $this->user = $user;
        $this->reminderNumber = $reminderNumber;
    }

    public function build()
    {
        return $this->view('emails.course_reminder')
                    ->with([
                        'user' => $this->user,
                        'reminderNumber' => $this->reminderNumber,
                    ]);
    }
}
