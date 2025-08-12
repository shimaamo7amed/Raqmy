<?php
namespace App\Services\Forms;
use App\Models\Users\UsersUsersM;
use Illuminate\Support\Facades\Mail;
use App\Models\Forms\FormsContactUSM;
use App\Models\Forms\FormsInstructorsM;
use Filament\Notifications\Notification;


class FormsInstructorsServices
{

    static public function InstructorsForm(array $array)
    {
        if (request()->hasFile('cv')) {
            $array['cv'] = request()->file('cv')->store('cvs', 'public');
        }
        if (request()->hasFile('image')) {
            $array['image'] = request()->file('image')->store('images', 'public');
        }

        $data = FormsInstructorsM::create($array);

        $emailData = [
            'name_en'    => $data->name_en,
            'name_ar'    => $data->name_ar,
            'phone'      => $data->phone,
            'email'      => $data->email,
            'linkedIn'   => $data->linkedIn,
            'message'    => $data->message,
            'experince'  => $data->experince,
            'cv'         => asset('storage/' . $data->cv),
            'image'      => asset('storage/' . $data->image),
            'created_at' => $data->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $data->updated_at->format('Y-m-d H:i:s'),
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

