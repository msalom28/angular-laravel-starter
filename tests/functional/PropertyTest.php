<?php

use UnitConnection\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions; 

class PropertyTest extends TestCase
{
	use DatabaseTransactions;

	public function test_return_a_listing_of_properties()
	{
		$user = factory(UnitConnection\Models\User::class)->create();

		$token = JWTAuth::fromUser($user);

		$user = factory(UnitConnection\Models\Property::class)->create(['name' => 'abc property']);

		$this->get('/api/properties?token='.$token)->seeJson(['name' => 'abc property']);
	}

	function test_return_an_error_with_absent_token()
	{
		$this->get('/api/properties?token=')->seeJson(['error' => 'token_not_provided']);
	}



}