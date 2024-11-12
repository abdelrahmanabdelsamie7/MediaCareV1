<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\DoctorOffer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imagesoffer extends Model
{
    use HasFactory;
    protected $table = "imagesoffer";
    protected $guarded = [];
    public function doctoroffer()
    {
        return $this->belongsTo(DoctorOffer::class, 'doctoroffer_id');
    }
}
