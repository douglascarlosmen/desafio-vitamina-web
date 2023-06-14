<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Api\Http\Requests\LoginRequest;
use Modules\User\Contracts\Services\UserServiceInterface;

class ApiController extends Controller
{
    private $service;

    public function __construct(UserServiceInterface $userService)
    {
        $this->service = $userService;
    }

    public function auth(LoginRequest $request)
    {
        $user = $this->service->getUserByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Credenciais não autorizadas'
            ], 401);
        }

        return response()->json([
            'access_token' => $user->createToken($user->name)->plainTextToken
        ]);
    }
}
