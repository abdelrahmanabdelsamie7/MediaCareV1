<?php

namespace App\Http\Controllers\API;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\SpecializationRequest;

class SpecializationController extends Controller
{
    use JsonResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    public function index()
    {
        $specializations = Specialization::all();
        return $this->sendSuccess('Specializations Retreived Successfuly !', $specializations);
    }
    public function store(SpecializationRequest $request)
    {
        $specialization = Specialization::create($request->validated());
        return $this->sendSuccess('Specialization Added Successfuly !', $specialization);
    }
    public function show(string $id)
    {
        $specialization = Specialization::findOrFail($id);
        return $this->sendSuccess('Specialization Retrieved Successfuly!', $specialization);
    }
    public function update(SpecializationRequest $request, string $id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->update($request->validated());
        return $this->sendSuccess('Specialization Updated Successfuly !', $specialization);
    }
    public function destroy(string $id)
    {
        $specialization = Specialization::findOrFail($id);
        $specialization->delete();
        return $this->sendSuccess('Specialization Deleted Successfuly !');
    }
    public function SpecializationToDoctor(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'specialization_id' => 'required|exists:specializations,id',
        ]);
        $doctor = Doctor::findOrFail($request->doctor_id);
        $specialization = Specialization::findOrFail($request->specialization_id);
        $specialization->doctors()->attach($doctor->id);
        return $this->sendSuccess('Specialization Added To Doctor Successfuly !');
    }
}
