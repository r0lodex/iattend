var iattend = angular.module('iattend', ['ngRoute'])
	.run(function($rootScope) {
		console.log('Started!')
	})
/*
 	ROUTE CONFIGURATION
 	---------------------
	Ini adalah konfigurasi untuk URL.
	Contohnya app/#/students akan pergi ke halaman 'Students'.
	Setiap URL ada Controller, yang mengawal data dan interaksi terhadap halaman tersebut,
	dan TemplateUrl, untuk menentukan layout halaman tersebut.
*/
	.config(function($routeProvider) {
		$routeProvider
			.when('/students', {
				controller: 'studentsController',
				templateUrl: 'templates/students.html'
			})
			.when('/events', {
				controller: 'eventsController',
				templateUrl: 'templates/events.html'
			})
			.otherwise({
				redirectTo: '/events'
			});
		// $locationProvider.html5mode(true);
	})

/*
 	DATA FACTORY
 	---------------------
	Section ini adalah untuk mengumpulkan data yang terdapat dalam database
	untuk digunakan didalam Controller masing-masing.
*/
	.factory('StudentsData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?student=1&action=read')
			.success(function(response) {
				deferred.resolve(response);
		});

		return deferred.promise;
	})

	.factory('EventsData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?event=1&action=read')
			.success(function(response) {
				deferred.resolve(response);
		});

		return deferred.promise;
	})

	.factory('AttendanceData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?attendance=1&action=read')
			.success(function(response) {
				deferred.resolve(response);
		});

		return deferred.promise;
	})

/*
 	CONTROLLER
 	---------------------
	Controller berfungsi mengawal interaksi dan data untuk halaman yang terlibat.
*/
	.controller('linkCtrl', function($scope, $location) {
		$scope.isActive = function(route) {
	        return route === $location.path();
	    }
	})

	.controller('studentsController', function($scope, $http, StudentsData) {

		$scope.studentList = [{"id":"1","fullname":"Abu Tausi Jaiha","ic":"881203-56-5857","matrix_no":"MYRF12345","serial_no":"#1234"},{"id":"2","fullname":"Kamarul Arifin Yahya","ic":"860712-14-9983","matrix_no":"MYRF45678","serial_no":"#4567"}];

		// StudentsData.then(function(res) {
		// 	$scope.studentList = res;
		// })

		$scope.update = function() {}
		$scope.delete = function() {}
	})

	.controller('eventsController', function($scope, $http, EventsData, AttendanceData) {
		$scope.list = function() {}
		$scope.update = function() {}
		$scope.delete = function() {}
	})