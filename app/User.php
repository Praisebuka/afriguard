<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, HasApiTokens;

    public $table = 'users';

    protected $hidden = [ 'password', 'remember_token', ];

    protected $dates = [ 'updated_at', 'created_at', 'deleted_at', ];

    protected $fillable = [ 'name', 'email', 'password', 'phone', 'created_at', 'updated_at', 'deleted_at', 'remember_token', 'email_verified_at', ];

    public function getEmailVerifiedAtAttribute($value)
    {
        if (!$value) { return null; }

        try {
            // Default to database format if config is not set
            $dateFormat = config('panel.date_format', 'Y-m-d');
            $timeFormat = config('panel.time_format', 'H:i:s');
            $format = $dateFormat . ' ' . $timeFormat;

            return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format($format);
        } catch (Exception $e) {
            Log::error('Failed to parse email_verified_at: ' . $e->getMessage());
            return $value; // Return raw value to avoid breaking the application
        }
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        if (!$value) {
            $this->attributes['email_verified_at'] = null;
            return;
        }

        try {
            // Default to database format if config is not set
            $dateFormat = config('panel.date_format', 'Y-m-d');
            $timeFormat = config('panel.time_format', 'H:i:s');
            $format = $dateFormat . ' ' . $timeFormat;

            $this->attributes['email_verified_at'] = Carbon::createFromFormat($format, $value)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            Log::error('Failed to set email_verified_at: ' . $e->getMessage());
            $this->attributes['email_verified_at'] = null;
        }
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}