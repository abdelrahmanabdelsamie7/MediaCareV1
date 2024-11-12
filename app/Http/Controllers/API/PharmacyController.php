<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PharmacyRequest;
use App\Models\Pharmacy;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    use JsonResponseTrait;
    // public function __construct()
    // {
    //     $this->middleware('auth:admins');
    // }
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return $this->sendSuccess('Pharmacies Retrieved Successfully !', $pharmacies);
    }
    public function store(PharmacyRequest $request, Pharmacy $pharmacy)
    {
        $pharmacy = Pharmacy::create($request->validated());
        return $this->sendSuccess('Pharmacy Added Successfully !', $pharmacy);
    }
    public function show(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        return $this->sendSuccess('Pharmacy Retrieved Successfully !', $pharmacy);
    }
    public function update(PharmacyRequest $request, string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update($request->validated());
        return $this->sendSuccess('Pharmacy Updated Successfully !', $pharmacy);
    }
    public function destroy(string $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();
        return $this->sendSuccess('Pharmacy Deleted Successfully !');
    }
}
