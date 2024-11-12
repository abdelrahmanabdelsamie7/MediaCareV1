<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ClinicRequest;
use App\Models\Clinic;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    use JsonResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->except(['index', 'show']);
    }
    public function index()
    {
        $clinics = Clinic::all();
        return $this->sendSuccess('Clinics Retrieved Successfully !', $clinics);
    }
    public function store(ClinicRequest $request, Clinic $clinic)
    {
        $clinic = Clinic::create($request->validated());
        return $this->sendSuccess('Clinic Added Successfully !', $clinic);
    }
    public function show(string $id)
    {
        $clinic = Clinic::with(['imagesclinic', 'doctor'])->findOrFail($id);
        return $this->sendSuccess('Clinic Retrieved Successfully !', $clinic);
    }
    public function update(ClinicRequest $request, string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->update($request->validated());
        return $this->sendSuccess('Clinic Updated Successfully !', $clinic);
    }
    public function destroy(string $id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();
        return $this->sendSuccess('Clinin Deleted Successfully !');
    }
}
