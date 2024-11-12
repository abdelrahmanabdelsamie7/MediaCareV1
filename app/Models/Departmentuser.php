<?php

namespace App\Models;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departmentuser extends Model
{
    use HasFactory;
    protected $table = 'department_user';
    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    } public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
