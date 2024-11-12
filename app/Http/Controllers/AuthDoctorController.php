<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;

class AuthDoctorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:doctors', ['except' => ['login', 'register']]);//login, register methods won't go through the api guard
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth('doctors')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'second_name' => 'required|string|between:2,100',
            'third_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'title' => 'required',
            'image' => 'required',
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|string|email|max:100|unique:doctors',
            'gender' => 'required',
            'phone' => 'required',
            'detectionPrice' => 'required',
            'infoDoctor' => 'required',
            'birth_date' => 'required',
            'homeOption' => 'required',
            'department_id' => 'required',
            'userType'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $doctor = Doctor::create([
            'first_name' => $request->get('first_name'),
            'second_name' => $request->get('second_name'),
            'third_name' => $request->get('third_name'),
            'last_name' => $request->get('last_name'),
            'title' => $request->get('title'),
            'image' => $request->get('image'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'detectionPrice' => $request->get('detectionPrice'),
            'gender' => $request->get('gender'),
            'homeOption' => $request->get('homeOption'),
            'infoDoctor' => $request->get('infoDoctor'),
            'birth_date' => $request->get('birth_date'),
            'department_id' => $request->get('department_id'),
            'password' => Hash::make($request->get('password')),
            'userType' => $request->get('userType')
        ]);

        $token = JWTAuth::fromUser($doctor);

        return response()->json([
            'message' => 'Doctor successfully registered',
            'doctor' => $doctor,
            'token' => $token,
        ], 200);
    }

    public function getaccount()
    {
        return response()->json(auth('doctors')->user());
    }


    public function logout()
    {
        auth('doctors')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth('doctors')->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('doctors')->factory()->getTTL() * 60 //mention the guard name inside the auth fn
        ]);
    }
}
