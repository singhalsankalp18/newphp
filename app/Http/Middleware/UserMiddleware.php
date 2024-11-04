<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessToken = $request->header('accessToken');
        // Check if the access token is provided
        if (!$accessToken) {
            return response()->json(['message' => 'Access Token is required'], 403);
        }
        // Validate the access token
        $user = User::where('personal_access_tokens', $accessToken)->first();
        if (!$user) {
            return response()->json(['message' => 'Invalid access token'], 401);
        }
        // Attach the user data to the request
        $request->merge(['UserData' => $user]);
        // Check if the user is identified as 3
        if ($user->identify_as == 3) {
            return $next($request);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }

}
