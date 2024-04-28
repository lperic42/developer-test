<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $position
 * @property int $account_id
 */
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
