<?php

namespace App\Models\Courses;

class PromoCodesM extends Model
{
    protected $table = "promocode";
    public $timestamps = true;

    protected $fillable =
    [
        'code',
        'discount_percentage',
        'is_active',
        'expires_at'

    ];
    public function isValid()
    {
        return $this->is_active && (!$this->expires_at || $this->expires_at->isFuture());
    }
}

