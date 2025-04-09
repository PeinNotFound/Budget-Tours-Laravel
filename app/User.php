<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'about', 'avatar', 'email_notifications', 'marketing_emails', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_notifications' => 'boolean',
        'marketing_emails' => 'boolean',
        'is_admin' => 'boolean',
    ];

    /**
     * Get the user's admin status.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return (bool) $this->attributes['is_admin'];
    }
}
