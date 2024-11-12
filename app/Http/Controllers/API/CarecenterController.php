<?php

namespace App\Http\Controllers\API;

use App\Models\Carecenter;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CarecenterRequest;

class CarecenterController extends Controller
{
    use JsonResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->except(['index', 'show']);
    }
    public function index()
    {
        $carecenters = Carecenter::all();
        return $this->sendSuccess('Care Centers Retrieved Successfuly !', $carecenters);
    }
    public function store(CarecenterRequest $request, Carecenter $carecenter)
    {
        $carecenter = Carecenter::create($request->validated());
        return $this->sendSuccess('Care Center Added Successfuly !', $carecenter);

    }
    public function show(string $id)
    {
        $carecenter = CareCenter::findOrFail($id)->with('departments')->get();
        return $this->sendSuccess('Specific Care Center Retreived Successfuly !', $carecenter);
    }
    public function update(CarecenterRequest $request, string $id)
    {
        $carecenter = Carecenter::findOrFail($id);
        $carecenter->update($request->validated());
        return $this->sendSuccess('Care Center Updated Successfuly !', $carecenter);
    }
    public function destroy(string $id)
    {
        $carecenter = Carecenter::findOrFail($id);
        $carecenter->delete();
        return $this->sendSuccess('Care Center Deleted Successfuly !');
    }
    public function DepToCarecenter(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'carecenter_id' => 'required|exists:carecenters,id',
            'detectionPrice' => 'required|numeric',
            'start_at' => 'required|date_format:Y-m-d H:i:s',
            'end_at' => 'required|date_format:Y-m-d H:i:s|after:start_at'
        ]);
        $carecenter = Carecenter::findOrFail($request->carecenter_id);
        $department = Department::findOrFail($request->department_id);
        $carecenter->departments()->attach($department->id, [
            'detectionPrice' => $request->detectionPrice,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);
        return response()->json(['success' => true, 'message' => 'Department Added To Care Center Successfully!'], 200);
    }
}
