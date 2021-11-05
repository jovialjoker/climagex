<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eveniment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat', 'long', 'name', 'description', 'started_at', 'ended_at', 'banner_picture', 'organization_id', 'participants', 'type', 'closed'
    ];

    protected $casts = [
        'closed' => 'boolean'
    ];
}
