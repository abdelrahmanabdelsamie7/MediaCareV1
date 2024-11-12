<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\DoctoroffersRequest;
use App\Models\Doctor;
use App\Models\DoctorOffer;

use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class DoctoroffersController extends Controller
{
    use JsonResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    public function index()
    {
        $doctoroffers = DoctorOffer::all();
        return $this->sendSuccess('Doctor Offers Retrieved Successfully !', $doctoroffers);
    }
    public function store(DoctoroffersRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['priceAfterDiscount'] = $validatedData['priceBeforDiscount'] - ($validatedData['priceBeforDiscount'] * $validatedData['discount'] / 100);
        unset($validatedData['priceAfterDiscount']);
        $doctoroffer = DoctorOffer::create($validatedData);
        return $this->sendSuccess('Doctor Offer Added Successfully !', $doctoroffer);
    }
    public function show(string $id)
    {
        $doctoroffer = DoctorOffer::with(['doctor', 'imagesoffer'])->findOrFail($id);
        return $this->sendSuccess('Doctor Offer Retrieved Successfully !', $doctoroffer);
    }
    public function update(DoctoroffersRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $validatedData['priceAfterDiscount'] = $validatedData['priceBeforDiscount'] - ($validatedData['priceBeforDiscount'] * $validatedData['discount'] / 100);
        unset($validatedData['priceAfterDiscount']);
        $doctoroffer = DoctorOffer::findOrFail($id);
        $doctoroffer->update($validatedData);
        return $this->sendSuccess('Doctor Offer Updated Successfully !', $doctoroffer);
    }
    public function destroy(string $id)
    {
        $doctoroffer = DoctorOffer::findOrFail($id);
        $doctoroffer->delete();
        return $this->sendSuccess('Doctor Offer Deleted Successfully !');
    }
}
