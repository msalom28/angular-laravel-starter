(function(){
	'use strict'

	angular
		.module('MyApp')
		.service('AuthService', AuthService);

		function AuthService($auth, $rootScope, $state){

			var self = this;

			this.logout = function(){

				//Remove the satellizer_token from localstorage
				$auth.logout().then(function(){

				//Remove the authenticated user from local storage
				localStorage.removeItem('user');

				//Flip authenticated to false so that we no longer
				//show UI elements dependant on the user being logged in
				$rootScope.authenticated = false;

				//Remove the current user from rootscope
				$rootScope.currentUser = null;

				$state.go('auth');

				});

			}
		}

})();