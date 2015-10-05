(function() {

	'user strict';

	angular
		.module('UnitConnection')
		.controller('UserController', UserController);

		function UserController( $http, $auth, $rootScope )
		{
			var uc = this;

			uc.users;
			uc.error;

			uc.getUsers = function() {

				$http.get('api/authenticate').success( function( users ){

					uc.users = users;

				}).error( function( error ){

					uc.error = error;

				});
			}

			//We would normally put the logout method in the same
			//spot as the login method, ideally extracted out into
			//a service. For this simpler example we'll leave it here
			uc.logout = function() {

				//Remove the satellizer_token from localstorage
				$auth.logout().then(function(){

					//Remove the authenticated user from local storage
					localStorage.removeItem('user');

					//Flip authenticated to false so that we no longer
					//show UI elements dependant on the user being logged in
					$rootScope.authenticated = false;

					//Remove the current user from rootscope
					$rootScope.currentUser = null;

				});

			}
		}

})();