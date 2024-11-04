<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'country_code' => 'required|string|max:5',
            'mobile' => 'required|string|max:15|unique:users,mobile',
            'password' => 'required|string|min:6',
            'profileImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
        $imageName = null;
        if ($request->hasFile('profileImg')) {
            $imageName = $this->uploadProfileImage($request->file('profileImg'));
        }
        $user = User::create([
            'name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'profile_img' => $imageName,
            'identify_as' => 3,
            'wallet' => 0,
            'email_verified_at' => now(),
            'personal_access_tokens' => bin2hex(random_bytes(30)),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
            ]
        ], 201);
    }
    private function uploadProfileImage($file)
    {
        $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile_images'), $imageName);
        return $imageName;
    }

    public function Login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where(['email'=> $request->email, 'identify_as', 3])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }
        Auth::login($user);
        // Return the user and token
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => $user
            ]
        ], 200);   
    }
    public function Profile(Request $request)
    {
        $userProfile = User::where('id', $request->UserData->id)->first();
        return response()->json(['message' => 'User Profile', 'status' => 200, 'data' => $userProfile], 200);
    }
}
