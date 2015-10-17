<?php

use UnitConnection\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions; 

class AuthTest extends TestCase
{
	use DatabaseTransactions;	

	function test_login_page_displays_succesfully()
	{
		$this->visit('/')->see('Unit Connection');
	}

	function test_authenticate_user_with_valid_credentials()
	{
		$user = factory(UnitConnection\Models\User::class)->create();

		$this->post('/api/authenticate', ['email' => $user->email, 'password' => 'secret'])->seeJson(['message' => 'token_created']);

	}

	function test_returns_an_error_with_invalid_credentials()
	{
		$user = factory(UnitConnection\Models\User::class)->create();

		$this->post('/api/authenticate', ['email' => 'foo@bar.com', 'password' => 'secret'])->seeJson(['error' => 'The email/password combination is incorrect.']);
	}	

	function test_return_the_authenticated_user()
	{
		$user = factory(UnitConnection\Models\User::class)->create();

		$token = JWTAuth::fromUser($user);

		$this->get('/api/authenticate/user?token='.$token)->seeJson(['name' => $user->name, 'email' => $user->email]);

	}

	function test_return_an_error_with_invalid_token()
	{
		$user = factory(UnitConnection\Models\User::class)->create();

		$this->get('/api/authenticate/user?token='.'ysus7')->seeJson(['error' => 'token_not_provided']);

	}

	function test_return_an_error_with_absent_token()
	{
		$user = factory(UnitConnection\Models\User::class)->create();

		$this->get('/api/authenticate/user?token=')->seeJson(['error' => 'token_not_provided']);

	}



}