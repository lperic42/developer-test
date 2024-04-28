<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 *
 * @property string $id
 * @property string $name
 * @property string $address
 * @property string $town_city
 * @property string $country
 * @property int $post_code
 * @property string $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property User $owner_id
 * @property Collection|Contact[] $contacts
 *
 */

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'address',
        'town_city',
        'country',
        'post_code',
        'phone',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
