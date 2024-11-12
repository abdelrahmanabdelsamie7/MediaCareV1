<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\DepartmentRequest;
use App\Models\Department;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use JsonResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->except(['index', 'show', 'AllInfoDepartment']);
    }
    public function index()
    {
        $departments = Department::all();
        return $this->sendSuccess('Departments Retrieved Successfuly!', $departments);
    }
    public function AllInfoDepartment()
    {
        $departments = Department::with(['doctors', 'hospitals', 'carecenters'])->get();
        return $this->sendSuccess('Departments With All Data are Retrieved Successfuly!', $departments);
    }
    public function store(DepartmentRequest $request, Department $department)
    {
        $department = Department::create($request->validated());
        return $this->sendSuccess('Department Added Successfuly!', $department);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::with(['doctors', 'hospitals', 'carecenters'])->findOrFail($id);
        if (!$department) {
            return $this->sendError('Department Not Found!', null, 404);
        }
        return $this->sendSuccess('Department Retrieved Successfuly!', $department);
    }
    public function update(DepartmentRequest $request, string $id)
    {
        $department = Department::findOrFail($id);
        $department->update($request->validated());
        return $this->sendSuccess('Department Updated Successfuly !', $department);
    }
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return $this->sendSuccess("Department Removed Successfuly !");
    }
}
