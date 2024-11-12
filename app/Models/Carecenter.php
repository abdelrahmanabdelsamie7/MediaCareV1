<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carecenter extends Model
{
    use HasFactory;
    protected $table = "carecenters";
    protected $guarded = [];
    public function departments()
    {
        return $this->belongsToMany(Department::class)->withPivot('detectionPrice', 'start_at', 'end_at')->withTimestamps();
        ;
    }
}
