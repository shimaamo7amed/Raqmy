<?php


namespace App\Services\Forms;
use Illuminate\Support\Facades\Mail;
use App\Models\Forms\FormsContactUSM;
use App\Models\Forms\FormsInstructorsM;
use Filament\Notifications\Notification;


class FormsInstructorsServices
{

static public function InstructorsForm(array $array)
{
    $data = FormsInstructorsM::create($array);
    // dd($data);
    $emailData = [
        'name'    => $data->name,
        'phone'   => $data->phone,
        'email'   => $data->email,
        'linkedIn'   => $data->linkedIn,
        'message' => $data->message,
    ];
   Mail::send('mails.instructors', ['emailData' => $emailData], function ($message) {
    $message->to('shimaa0mohamed19@gmail.com')
        ->subject('New Contact Form Submission');
});

    Notification::make()
        ->title('New Contact Form Submission')
        ->body("A new message from {$data->name}.")
        ->send();

    return $data;
}



}

