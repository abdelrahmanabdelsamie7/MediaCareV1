<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Imagesclinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory;
    protected $table = 'clinics';
    protected $guarded = [];
    public function imagesclinic()
    {
        return $this->hasMany(Imagesclinic::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
