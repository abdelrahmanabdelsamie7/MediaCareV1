<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory;
    protected $table = 'specializations';
    protected $guarded = [];
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
