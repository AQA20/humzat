<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * Register a new user (or return existing) and issue auth token.
     *
     * Registers a user with the provided email, username, and password.
     * If a user with the same email or username already exists, the existing user is returned.
     * Returns a new authentication token either way.
     *
     * @group Authentication
     * @unauthenticated
     *
     * @bodyParam username string required The desired username. Example: johndoe
     * @bodyParam email string required A unique email address. Example: john@example.com
     * @bodyParam password string required A secure password. Example: secret123
     * @bodyParam password_confirmation string required Must match the password. Example: secret123
     *
     * @response 201 {
     *   "user": {
     *     "id": "01986aab-55e5-7089-ad78-e92294877610",
     *     "username": "johndoe",
     *     "name": null,
     *     "bio": null,
     *     "profile_picture_url": null,
     *     "created_at": "2025-08-02T12:00:00.000000Z",
     *     "updated_at": "2025-08-02T12:00:00.000000Z",
     *     "email": "john@example.com"
     *   },
     *   "token": "1|abcd1234..."
     * }
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::where('email', $request->email)
            ->orWhere('username', $request->username)
            ->first();

        if (!$user) {
            $user = User::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], Response::HTTP_CREATED);
    }
}
