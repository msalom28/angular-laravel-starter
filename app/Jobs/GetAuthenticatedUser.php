<?php

namespace MyApp\Jobs;

use JWTAuth;
use MyApp\Jobs\Job;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Bus\SelfHandling;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class GetAuthenticatedUser extends Job implements SelfHandling
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
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
}
