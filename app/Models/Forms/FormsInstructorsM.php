<?php

namespace App\Models\Forms;
use Illuminate\Database\Eloquent\Model;

class FormsInstructorsM  extends Model
{
    public $timestamps = true;
    protected $table = "forms_instructors";

    protected $fillable = [
    'name_en',
    'name_ar',
    'email',
    'phone',
    'message',
    'linkedIn',
    'experince',
    'cv'
    ];
    protected $hidden = [
        'id',
    ];
}
