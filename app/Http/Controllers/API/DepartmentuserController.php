<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Departmentuser;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\DepartmentuserRequest;

class DepartmentuserController extends Controller
{
    use JsonResponseTrait;
    public function index()
    {
        $consulations = Departmentuser::all();
        return $this->sendSuccess('Consulations Retrieved Successfully !', $consulations);
    }
    public function store(DepartmentuserRequest $request)
    {
        $validatedRequest = $request->validated();
        $department_id = $validatedRequest['department_id'];
        $doctors = Doctor::where('department_id', $department_id)->get();
        $consultations = [];
        foreach ($doctors as $doctor) {
            $consultation = Departmentuser::create([
                'department_id' => $validatedRequest['department_id'],
                'doctor_id' => $doctor->id,
                'user_id' => $validatedRequest['user_id'],
                'message' => $validatedRequest['message'],
                'date' => Carbon::now(),
            ]);
            $consultations[] = $consultation;
        }
        return $this->sendSuccess('Consultations Sent Successfully', $consultations);
    }
    public function show(string $id)
    {
        $consultation = Departmentuser::findOrFail($id);
        return $this->sendSuccess('Consultation Retrieved Successfully !', $consultation);
    }
    public function update(Request $request, string $id)
    {

    }
    public function destroy(string $id)
    {
        $consultation = Departmentuser::findOrFail($id);
        $consultation->delete();
        return $this->sendSuccess('Consultation Deleted Successfully !');
    }
    public function reply(Request $request, string $id)
    {
        $request->validate([
            'repaly' => 'required|string',
        ]);
        $consultation = Departmentuser::findOrFail($id);
        $consultation->repaly = $request->repaly;
        $consultation->save();
        return $this->sendSuccess('Reply Sent Successfully!', $consultation);
    }

}
