<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * Represents a User entity in the application.
 *
 * This class extends Laravel's Authenticatable class and includes traits for API tokens,
 * factory methods, and notifications. It represents a user of the application with
 * functionalities for authentication and authorization.
 *
 * @property int $id The unique identifier for the user.
 * @property string $name The name of the user.
 * @property string $email The email address of the user.
 * @property string $password The hashed password for the user.
 * @property \Illuminate\Support\Carbon|null $email_verified_at Timestamp when the email was verified.
 * @property string|null $remember_token Token used to remember the user's session.
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications The notifications related to the user.
 * @property-read int|null $notifications_count The count of notifications related to the user.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
