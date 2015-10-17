(function(){

	'use strict';

	angular
		.module('UnitConnection')
		.controller('PropertyController', PropertyController);

		function PropertyController(PropertyService){

			var pc = this;			

			pc.getProperties = function(){

				PropertyService.getProperties().then(function(results){
					pc.properties = results.data;
				}, function(error){
					console.log('An error ocurred');
				});

			}

		}




})();