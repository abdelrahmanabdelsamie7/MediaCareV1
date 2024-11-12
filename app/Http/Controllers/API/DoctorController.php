<?php
namespace App\Http\Controllers\API;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\DoctorRequest;

class DoctorController extends Controller
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth('admins')->check() || auth('doctors')->check()) {
                return $next($request);
            }
            return response()->json(['error' => 'Not Authorized'], 403);
        })->only(['show', 'update']);
    }

    //Admin Else Can Get All Doctors
    public function index()
    {
        if (auth('admins')->check()) {
            $doctors = Doctor::all();
            return $this->sendSuccess('Doctors Retrieved Successfully!', $doctors);
        }
        return $this->sendNotAuth('Not Authorized !');
    }

    // Admin Else Can Add New Doctor
    public function store(DoctorRequest $request, Doctor $doctor)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($request->password);
        $doctor = Doctor::create($validatedData);
        if (auth('admins')->check()) {
            return $this->sendSuccess('Doctor Added Successfully!', $doctor);
        }
        return $this->sendNotAuth('Not Authorized !');
    }

    // Doctor Who Auth Can Else Show Thier Data And Admin Else
    public function show(string $id)
    {
        $doctor = Doctor::with(['department', 'specializations', 'doctoroffers', 'clinics'])->findOrFail($id);

        // التحقق من صلاحية Admin أو إذا كان Doctor يحاول الوصول إلى بياناته
        if (auth('admins')->check() || (auth('doctors')->check() && auth('doctors')->user()->id == $doctor->id)) {
            return $this->sendSuccess('Doctor Retrieved Successfully!', $doctor);
        }

        return response()->json(['error' => 'Not Authorized'], 403);
    }

    // Doctor Who Auth Can Else Update Thier Data And Admin Else
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|between:2,100',
            'second_name' => 'required|string|between:2,100',
            'third_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'title' => 'required',
            'image' => 'required',
            'password' => 'nullable|string|confirmed|min:6',
            'phone' => 'required',
            'detectionPrice' => 'required',
            'infoDoctor' => 'required',
            'birth_date' => 'required',
            'homeOption' => 'required',
        ]);
        $doctor = Doctor::findOrFail($id);
        if (auth('admins')->check() || (auth('doctors')->check() && auth('doctors')->user()->id == $doctor->id)) {
            $validatedData = $request->only([
                /* Delete Name From Update ,
                * birth_date
                */
                'first_name',
                'second_name',
                'third_name',
                'last_name',
                'title',
                'image',
                'phone',
                'detectionPrice',
                'infoDoctor',
                'birth_date',
                'homeOption',
            ]);
            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($request->password);
            }
            $doctor->update($validatedData);
            return $this->sendSuccess('Doctor Updated Successfully!', $doctor);
        }

        return $this->sendNotAuth('Not Authorized');
    }

    // Admin Else Can Remove Doctor
    public function destroy(string $id)
    {
        if (auth('admins')->check()) {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
            return $this->sendSuccess('Doctor Removed Successfuly !');
        }
        return $this->sendNotAuth('Not Authorized ');
    }
}
