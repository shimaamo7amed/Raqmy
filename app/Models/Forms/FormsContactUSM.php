<?php

namespace App\Models\Forms;
use Illuminate\Database\Eloquent\Model;

class FormsContactUSM  extends Model
{
    public $timestamps = true;
    protected $table = "forms_contact_us";

    protected $fillable = [
    'name',
    'email',
    'phone',
    'message',
    ];
    protected $hidden = [
        'id',
    ];
}
