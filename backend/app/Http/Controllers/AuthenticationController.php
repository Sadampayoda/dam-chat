<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AuthenticationRequest $request)
    {
        try {
            $input = $request->validated();

            if(Auth::attempt($input))
            {
                $user = auth()->user();
                $token = $user->createToken('apiDamChat')->plainTextToken;
                return response()->json([
                    'data' => $request->all(),
                    'token' => $token,
                    'success' => true,
                ],202);
            }
            return response()->json([
                'data' => $request->all(),
                'message' => 'Hmmm gagal masuk deh, mungkin salah password',
                'success' => false,
            ],505);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 505,
                'success' => false,
                'message' => 'Hmmm gagal masuk deh',
                'error' => $th->getMessage(),
            ]);
        }
    }
}
