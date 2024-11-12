<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDoctorIdentity
{
    public function handle(Request $request, Closure $next)
    {
        // الحصول على الدكتور المسجل
        $doctor = Auth::guard('doctors')->user();

        // التحقق من وجود الدكتور في الـ Auth Guard
        if (!$doctor) {
            return response()->json(['message' => 'Unauthorized Access: Not Authenticated'], 401);
        }

        // التحقق من إن الدكتور اللي بيطلب العملية هو نفس الدكتور في الـ URL
        if ($doctor->id != $request->route('id')) {
            return response()->json(['message' => 'Unauthorized Access: Forbidden'], 403);
        }

        return $next($request);
    }
}

