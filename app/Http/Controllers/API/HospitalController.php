<?php

namespace App\Http\Controllers\API;

use App\Models\Hospital;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\HospitalRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HospitalController extends Controller
{
    use JsonResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->except(['index', 'show']);
    }
    public function index()
    {
        $hospitals = Hospital::all();
        return $this->sendSuccess('Hospitals Retrieved Successfuly !', $hospitals);
    }
    public function store(HospitalRequest $request, Hospital $hospital)
    {
        $hospital = Hospital::create($request->validated());
        return $this->sendSuccess('Hospital Added Successfuly !', $hospital);
    }
    public function show(string $id)
    {
        $hospital = Hospital::findOrFail($id)->with('departments')->get();
        return $this->sendSuccess('Hospital Retrieved Successfuly !', $hospital);
    }
    public function update(HospitalRequest $request, string $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update($request->validated());
        return $this->sendSuccess('Hospital Updated Successfuly !', $hospital);
    }
    public function destroy(string $id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();
        return $this->sendSuccess('Hospital Removed Successfuly !');
    }
    public function DepToHos(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'hospital_id' => 'required|exists:hospitals,id',
            'detectionPrice' => 'required|numeric',
            'start_at' => 'required|date_format:Y-m-d H:i:s',
            'end_at' => 'required|date_format:Y-m-d H:i:s|after:start_at'
        ]);
        $hospital = Hospital::findOrFail($request->hospital_id);
        $department = Department::findOrFail($request->department_id);
        $hospital->departments()->attach($department->id, [
            'detectionPrice' => $request->detectionPrice,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);
        return response()->json(['success' => true, 'message' => 'Department Added To Hospital Successfully!'], 200);
    }
}

