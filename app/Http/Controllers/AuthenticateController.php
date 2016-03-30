<?php

namespace MyApp\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use MyApp\Http\Controllers\Controller;

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
        $json = $this->dispatchFrom('MyApp\Jobs\GetAuthenticatedUser', $request);

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
        $json = $this->dispatchFrom('MyApp\Jobs\AuthenticateUser', $request);

        return $json;
    }
}
