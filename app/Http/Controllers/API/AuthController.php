<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();
        $user = $this->authRepository->create($request->all());

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = $this->authRepository->findByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $token = Auth::login($user);

        return response()->json([
            'message' => 'Successfully login',
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        $this->authRepository->logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        $result = $this->authRepository->refresh();

        return response()->json($result);
    }
}
