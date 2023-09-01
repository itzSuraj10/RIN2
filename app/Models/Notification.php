<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'message', 'expires_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notification')
                    ->withPivot('is_read')
                    ->withTimestamps();
    }
}
