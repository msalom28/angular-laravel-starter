(function(){

	'use strict';

	angular
		.module('UnitConnection')
		.controller('WelcomeController', WelcomeController);

		function WelcomeController($state, $rootScope){

			var wc = this;

			if($rootScope.authenticated ){
				$state.go('dashboard');
			}
		}

})();