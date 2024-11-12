<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitals';
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsToMany(Department::class)->withPivot('detectionPrice', 'start_at', 'end_at')->withTimestamps();
        ;
    }
}
