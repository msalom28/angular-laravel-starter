(function(){

	'use strict';

	angular
		.module('MyApp', ['ui.router', 'ui.bootstrap', 'satellizer'])
		.config( function( $stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $provide ){

			//Contains the logic of what to do when certain responses are encountered
			function redirectWhenLoggetOut($q, $injector) {

				return {

					responseError: function(rejection){

						//Neet to user $injector.get to bring in $state or else we get
						//a circular dependency error
						//If we were to inject it in the traditional way—between the 
						//parentheses in the function definition—we’ll get a “circular dependency error”.
						var $state = $injector.get('$state');

						//Instead of checking for a status code of 400 which might be used
						//for other reasons in Laravel, we check for the specific rejection
						//reasons to tell us if we need to redirect to the login state
						var rejectionReasons = [
						'token_not_provided', 
						'token_expired', 
						'token_absent', 
						'token_invalid', 
						'user_not_found',
						'The email field is required.',
						'The password field is required.',
						'The email/password combination is incorrect.'];

						//Loop through each rejection reason and redirect to th login
						//state if one is encountered
						angular.forEach(rejectionReasons, function(value, key){

							if(rejection.data.error === value){

								//If we get a rejection corresponding to one of the reasons
								//in our array, we know we need to authenticate the user so
								//we can remove the current user from local storage
								localStorage.removeItem('user');

								//Send the user to the auth state so they can login
								$state.go('auth');
							}
						});

							return $q.reject(rejection);

					}
				}
			}

			//Setup for the $httpInterceptor
			$provide.factory('redirectWhenLoggetOut', redirectWhenLoggetOut);

			//Push the new factory onto the $http interceptor array
			$httpProvider.interceptors.push('redirectWhenLoggetOut');

			//Satellizer configuration that specifies which API
			//route the JWT should be retrieved from
			$authProvider.loginUrl = '/api/authenticate';

			//Redirect to the auth state if any other states
			// are requested other than users
			$urlRouterProvider.otherwise('/');

			$stateProvider
				.state('welcome', {
					url: '/',
					templateUrl: 'views/welcomeView.html',
					controller: 'WelcomeController as wc'
				})
				.state('auth', {
					url: '/auth',
					templateUrl: 'views/authView.html',
					controller: 'AuthController as ac'
				})
				.state('dashboard', {
					url: '/dashboard',
					templateUrl: 'views/dashboardView.html',
					controller: 'DashboardController as dc'

				});


		}).run(function($rootScope, $state){

			//$stateChangeStart is fired whenever the stae changes. we can use some parameters
			//such as toState to hook into details about the state as it is changing
			$rootScope.$on('$stateChangeStart', function(event, toState){

				//Grab th user from local storage and parse it to an object
				var user = JSON.parse(localStorage.getItem('user'));

				//If there is any user data in local storage then the user is quite
				//likely authenticated. If their token is expired, or if they are
				//otherwise not actually authenticated, they will be redirected to
				//the suth state because of the rejected request anyway
				if(user){

					//function to logout globally
					$rootScope.logout;

					//The user's authenticated state gets flipped to
					//true so we can now show parts of the UI that rely
					//on the user being logged in
					$rootScope.authenticated = true;

					//Putting the user's data on $rootScope allows
					//us to access it anywhere across the app. Here
					//we are grabbing what is in local storage
					$rootScope.currentUser = user;

					//If the user is logged in and we hit the auth route
					//we don't need to stay there and can send the user to the
					//main and can send the user to the main state
					if(toState.name === "auth"){

						//Preventing the default behavior allows us to use $state.go
						//to change states
						event.preventDefault();

						//go to the "main" state which in our case is users
						$state.go('dashboard');

					}

				}

			});

		});//end config


})();