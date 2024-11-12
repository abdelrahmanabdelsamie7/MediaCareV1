<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Clinic;
use App\Models\DoctorOffer;
use App\Models\Specialization;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'doctors';
    protected $guarded = [];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }
    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }
    public function doctoroffers()
    {
        return $this->hasMany(DoctorOffer::class);
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
