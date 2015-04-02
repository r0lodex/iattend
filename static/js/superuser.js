angular.module('iattend')
	.config(function($routeProvider) {
		$routeProvider
			.when('/admin', {
				controller: 'adminController',
				templateUrl: 'templates/admin.html'
			})
	})

	.factory('AdminData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?admin=true')
			.success(function(response) {
				deferred.resolve(response);
			}
		);

		return deferred.promise;
	})

	.controller('adminController', function($rootScope, $scope, $http, AdminData) {})