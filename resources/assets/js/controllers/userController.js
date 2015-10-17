(function() {

	'user strict';

	angular
		.module('UnitConnection')
		.controller('UserController', UserController);

		function UserController( $http, AuthService )
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

			uc.logout = function(){
				
				AuthService.logout();
			}
		}

})();