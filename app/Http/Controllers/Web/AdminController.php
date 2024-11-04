<?php

namespace App\Http\Controllers\Web;

use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function userManagement()
    {
        $userDetails = User::where('identify_as', 3)->get();
        return view('admin.usermanagement', compact('userDetails'));
    }

    public function userStatusUpdate(Request $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            $user->status = $request->status;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User status updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user status.'
            ]);
        }
    }

    public function warehousesManagement()
    {
        $warehouseDetails = User::where('identify_as', 2)->get();
        return view('admin.warehouses', compact('warehouseDetails'));
    }

    public function warehousesStore(Request $request)
    {
        $imageName = null;
        if ($request->hasFile('profileImage')) {
            $imageName = $this->uploadProfileImage($request->file('profileImage'));
        }
        $user = User::create([
            'name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'country_code' => $request->countryCode,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'profile_img' => $imageName,
            'identify_as' => 2,
            'wallet' => 0,
            'email_verified_at' => now(),
            'personal_access_tokens' => bin2hex(random_bytes(30)),
        ]);

        // Flash success message to session
        session()->flash('success', 'User registered successfully');

        // Redirect back or to a specific route
        return redirect()->back();
    }
    private function uploadProfileImage($file)
    {
        $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile_images'), $imageName);
        return $imageName;
    }

    public function warehousesSettings(Request $request, $Id)
    {
        dd($request->all(), $Id);
    }
}
