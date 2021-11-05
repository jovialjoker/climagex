<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'is_admin',
        'organization_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['organization'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function scopeCreateOrganizationOwner(Organization $organization) {
        $accountPassword = Str::random();

        return [self::create([
            'name' => $organization->name,
            'password' => $accountPassword,
            'email' => $organization->meta->email,
            'email_verified_at' => now(),
            'is_admin' => false,
            'organization_id' => $organization->id,
        ]), $accountPassword];
    }

    public function organization() {
        return $this->hasOne(Organization::class, 'owner_id');
    }
}
