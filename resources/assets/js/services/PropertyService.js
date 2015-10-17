(function(){

	'use strict';

	angular
		.module('UnitConnection')
		.service('PropertyService', PropertyService);

		function PropertyService($http){

			var self = this;

			this.getProperties = function(){
				return $http.get('/api/properties/');
			}

		}


})();