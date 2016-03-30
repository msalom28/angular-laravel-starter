<?php

namespace MyApp\Jobs;

use JWTAuth;
use Validator;
use MyApp\Jobs\Job;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Contracts\Bus\SelfHandling;

class AuthenticateUser extends Job implements SelfHandling
{   
    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $password
     */
    protected $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $password)
    {
        $this->email = $email;

        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $credentials = ['email' => $this->email, 'password' => $this->password];

        $validator = $this->validator($credentials);

         if($validator->fails()){
            return response()->json(['error' => $validator->errors()->first()], 401);
        }

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'The email/password combination is incorrect.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

         return response()->json(['token' => $token, 'message' => 'token_created'], 200);
    }
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * 
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator($data)
    {
        return Validator::make($data, [
            'email' => 'required',
            'password' => 'required'

        ]);
    }
}
