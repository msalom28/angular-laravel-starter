<?php

namespace UnitConnection\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use UnitConnection\Http\Controllers\Controller;

class AuthenticateController extends Controller
{

    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }
    

    /**
     * Get the authenticated user by dissecting the jwt token
     * 
     * @param Illuminate\Http\Request; $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser(Request $request)
    {
        $json = $this->dispatchFrom('UnitConnection\Jobs\GetAuthenticatedUser', $request);

        return $json;
    }


    /**
     * Authenticate the user
     * 
     * @param Illuminate\Http\Request; $request
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $json = $this->dispatchFrom('UnitConnection\Jobs\AuthenticateUser', $request);

        return $json;
    }
}
