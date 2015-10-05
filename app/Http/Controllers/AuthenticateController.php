<?php

namespace UnitConnection\Http\Controllers;

use JWTAuth;
use UnitConnection\User;
use Illuminate\Http\Request;
use UnitConnection\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Determine if user is authenticate by locating token
     */
    public function getAuthenticatedUser()
    {
        try {
            if( ! $user = JWTAuth::parseToken()->authenticate() ){
                return response()->json(['user_not_found'], 404);
            }
            
        } catch ( TokenExpiredException $e ) {
            return response()->json(['token_expired']. $e->getStatusCode());
            
        } catch ( TokenInvalidException $e ){
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch ( JWTException $e ) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        //The token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }
}
