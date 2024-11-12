<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Imagesoffer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorOffer extends Model
{
    use HasFactory;
    protected $table = 'doctoroffers';
    protected $guarded = [];
    public function getPriceAfterDiscountAttribute()
    {
        return $this->priceBeforDiscount - ($this->priceBeforDiscount * $this->discount / 100);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function imagesoffer()
    {
        return $this->hasMany(Imagesoffer::class);
    }
}
