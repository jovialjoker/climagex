<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'meta',
        'profile_picture',
        'type'
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
