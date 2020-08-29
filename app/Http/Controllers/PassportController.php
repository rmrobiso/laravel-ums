<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepositoryInterface;
use App\http\Resources\Passport as PassportResource;

class PassportController extends UserController
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $this->storeRules['password'] = ['required', 'string', 'min:8'];
        $this->storeRules['confirm_password'] = ['required', 'same:password'];
        array_push($this->storeRules['email'], 'unique:users');

        $validator = Validator::make($input, $this->storeRules);

        if ($validator->fails()) {  
            
            return new PassportResource(['error' => $validator->errors()]);
        }

        $input['password'] = Hash::make($input['password']);
        $data = $this->user->create($input);
        $data['token'] =  $data->createToken('AppName')->accessToken;

        return new PassportResource($data);
    }
 
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $data = auth()->user();
            $data['token'] = $data->createToken('AppName')->accessToken;
            
            return new PassportResource($data);

        } else {
            return new PassportResource(['message' => 'Unauthorized']);
        }
    }

	/**
     * Handles Logout Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
	    $token = $request->user()->token();
        $token->revoke();
        
	    return new PassportResource(['message' => "Successfully logged out"]);
	}
}
