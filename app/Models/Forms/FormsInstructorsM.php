<?php

namespace App\Models\Forms;
use Illuminate\Database\Eloquent\Model;

class FormsInstructorsM  extends Model
{
    public $timestamps = true;
    protected $table = "forms_instructors";

    protected $fillable = [
    'name',
    'email',
    'phone',
    'message',
    'linkedIn'
    ];
    protected $hidden = [
        'id',
    ];
}
