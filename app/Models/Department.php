<?php

namespace App\Models;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Carecenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $guarded = [];
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class)->withPivot('detectionPrice', 'start_at', 'end_at')->withTimestamps();
    }
    public function carecenters()
    {
        return $this->belongsToMany(Carecenter::class)->withPivot('detectionPrice', 'start_at', 'end_at')->withTimestamps();
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
