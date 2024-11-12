<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ImagesofferRequest;
use App\Models\Imagesoffer;
use App\Traits\JsonResponseTrait;
class ImagesofferController extends Controller
{
    use JsonResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    public function index()
    {
        $imageoffers = Imagesoffer::all();
        return $this->sendSuccess('Images Of Doctor Offer Retrieved Successfully !', $imageoffers);
    }
    public function store(ImagesofferRequest $request)
    {
        $imageoffer = Imagesoffer::create($request->validated());
        return $this->sendSuccess('Images Added To Doctor Offer Successfully !', $imageoffer);
    }
    public function show(string $id)
    {
        $imageoffer = Imagesoffer::with('doctoroffer')->findOrFail($id);
        return $this->sendSuccess('Image Of Doctor Offer Retrieved Successfully !', $imageoffer);
    }
    public function update(ImagesofferRequest $request, string $id)
    {
        $imageoffer = Imagesoffer::findOrFail($id);
        $imageoffer->update($request->validated());
        return $this->sendSuccess('Image Of Doctor Offer Updated Successfully !', $imageoffer);
    }
    public function destroy(string $id)
    {
        $imageoffer = Imagesoffer::findOrFail($id);
        $imageoffer->delete();
        return $this->sendSuccess('Image Of Doctor Offer Deleted Successfully !');
    }
}
