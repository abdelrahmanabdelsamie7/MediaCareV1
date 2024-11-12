<?php

use App\Http\Controllers\API\CarecenterController;
use App\Http\Controllers\API\ClinicController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\DepartmentuserController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\DoctoroffersController;
use App\Http\Controllers\API\HospitalController;
use App\Http\Controllers\API\ImagesclinicController;
use App\Http\Controllers\API\ImagesofferController;
use App\Http\Controllers\API\PharmacyController;
use App\Http\Controllers\API\SpecializationController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthDoctorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route User
Route::middleware(['api'])->group(function () {
    Route::post('/user/login', [AuthController::class, 'login']);
    Route::post('/user/logout', [AuthController::class, 'logout']);
    Route::post('/user/register', [AuthController::class, 'register']);
    Route::get('/user/getaccount', [AuthController::class, 'getaccount']);
});
// Route Admin
Route::middleware(['api'])->group(function () {
    Route::post('/admin/login', [AuthAdminController::class, 'login']);
    Route::post('/admin/logout', [AuthAdminController::class, 'logout']);
    Route::post('/admin/register', [AuthAdminController::class, 'register']);
    Route::get('/admin/getaccount', [AuthAdminController::class, 'getaccount']);
});
// Route Doctor Authentications
Route::middleware(['api'])->group(function () {
    Route::post('/doctor/login', [AuthDoctorController::class, 'login']);
    Route::post('/doctor/logout', [AuthDoctorController::class, 'logout']);
    Route::post('/doctor/register', [AuthDoctorController::class, 'register']);
    Route::get('/doctor/getaccount', [AuthDoctorController::class, 'getaccount']);
});
Route::apiResource('Doctors', DoctorController::class);
// Route Departments
Route::get('/AllInfoDepartments', [DepartmentController::class, 'AllInfoDepartment']);
Route::apiResource('/Departments', DepartmentController::class);
// Route Hospitals
Route::post('/DepartmentToHospital', [HospitalController::class, 'DepToHos']);
Route::apiResource('/Hospitals', HospitalController::class);
// Route Care Centers
Route::post('/DepToCarecenter', [CarecenterController::class, 'DepToCarecenter']);
Route::apiResource('CareCenters', CarecenterController::class);
// Route Specializations
Route::post('SpecializationToDoctor', [SpecializationController::class, 'SpecializationToDoctor']);
Route::apiResource('Specializations', SpecializationController::class);
// Route Pharamices
Route::apiResource('Pharmacies', PharmacyController::class);
// Route Clinics
Route::apiResource('Clinics', ClinicController::class);
// Route Images Of Clinics
Route::apiResource('AddImagesToClinic', ImagesclinicController::class);
// Route Of Doctor Offers
Route::apiResource('DoctorOffers', DoctoroffersController::class);
// Route Of Images Of Doctor Offers
Route::apiResource('ImagesOfDoctorOffers', ImagesofferController::class);
// Route Consulations
Route::post('ReplyConsulation/{id}', [DepartmentuserController::class, 'reply']);
Route::apiResource('Consulations', DepartmentuserController::class);
