<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'account',
    ];

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
