<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::to($user->email)->send(new ResetPasswordMail($token));

        return response()->json(['message' => 'Password reset email sent']);
    }

    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')->where('token', $token)->first();

        if (!$passwordReset) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $passwordReset->delete();

        return response()->json(['message' => 'Password reset successfully']);
    }
}