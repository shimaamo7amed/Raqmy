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
    if (request()->hasFile('cv')) {
        $file = request()->file('cv');
        $path = $file->store('cvs', 'public');
        $array['cv'] = $path;
    }

    $data = FormsInstructorsM::create($array);

    $emailData = [
        'name_en'    => $data->name_en,
        'name_ar'    => $data->name_ar,
        'phone'   => $data->phone,
        'email'   => $data->email,
        'linkedIn'   => $data->linkedIn,
        'message' => $data->message,
        'experince' => $data->experince,
        'cv' => asset('storage/' . $data->cv),
    ];

    Mail::send('mails.instructors', ['emailData' => $emailData], function ($message) {
        $message->to('shimaa0mohamed19@gmail.com')
            ->subject('New Contact Form Submission');
    });

    Notification::make()
        ->title('New Contact Form Submission')
        ->body("A new message from {$data->name_en}.")
        ->send();

    return $data;
}




}

