<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ImagesclinicRquest;
use App\Models\Imagesclinic;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class ImagesclinicController extends Controller
{
    use JsonResponseTrait;
    public function index()
    {
        $imagesclininc = Imagesclinic::all();
        return $this->sendSuccess('Images Of Clinics Retrieved Successfully !', $imagesclininc);
    }
    public function store(ImagesclinicRquest $request)
    {
        $imagesclininc = Imagesclinic::create($request->validated());
        return $this->sendSuccess('Images Added To Clinic Successfully !', $imagesclininc);
    }
    public function show(string $id)
    {
        $imagesclininc = Imagesclinic::with('clinic')->findOrFail($id);
        return $this->sendSuccess('Image Of Clinic Retrieved Successfully !', $imagesclininc);
    }
    public function update(ImagesclinicRquest $request, string $id)
    {
        $imagesclininc = Imagesclinic::findOrFail($id);
        $imagesclininc->update($request->validated());
        return $this->sendSuccess('Image Of Clinic Updated Successfully !', $imagesclininc);
    }
    public function destroy(string $id)
    {
        $imagesclininc = Imagesclinic::findOrFail($id);
        $imagesclininc->delete();
        return $this->sendSuccess('Image Of Clinic Deleted Successfully !');
    }
}
