(function(){

	'use strict';

	angular
		.module('MyApp')
		.controller('DashboardController', DashboardController);

		function DashboardController( $state, $rootScope, AuthService){

			var dc = this;

			if(! $rootScope.authenticated ){
				$state.go('auth');
			}

			$rootScope.logout = function(){
				AuthService.logout();
			}

			this.viewProperties = function(){
				$state.go('dashboard.properties');
			}			

		}





})();