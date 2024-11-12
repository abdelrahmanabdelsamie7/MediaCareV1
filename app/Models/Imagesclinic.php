<?php

namespace App\Models;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imagesclinic extends Model
{
    use HasFactory;
    protected $table = 'imagesclinic';
    protected $guarded = [];
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
