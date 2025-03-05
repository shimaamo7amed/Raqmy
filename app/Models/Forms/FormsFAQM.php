<?php

namespace App\Models\Forms;
use Illuminate\Database\Eloquent\Model;
class FormsFAQM  extends Model
{
    public $timestamps = true;
    protected $table = "forms_website_faq";
    protected $fillable = [
    'question',
    'answer'
    ];
    protected $hidden = [
        'id',
    ];
      protected $casts = [
        'question' => 'array',
        'answer' => 'array',
    ];
}
