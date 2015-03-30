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
			}
		);

		return deferred.promise;
	})

	.factory('EventsData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?event=1&action=read')
			.success(function(response) {
				deferred.resolve(response);
			}
		);

		return deferred.promise;
	})

	.factory('AttendanceData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?attendance=1&action=read')
			.success(function(response) {
				deferred.resolve(response);
			}
		);

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

		$scope.studentList = [];

		var fields = function(){
			this.ic_no = '';
			this.serial_no = '';
			this.fullname = '';
			this.matrix_no = '';
		}
		StudentsData.then(function(res) {
			$scope.studentList = res;
		});

		$scope.createStudent = function() {
			$scope.studentfields = new fields();
			$scope.studentfields.ic_no = $scope.ic_no
			$scope.studentfields.serial_no = $scope.serial_no
			$scope.studentfields.fullname = $scope.fullname
			$scope.studentfields.matrix_no = $scope.matrix_no

			$http.post('../php/router.php?student=1&action=create', $scope.studentfields)
				.success(function(res) {
					$scope.studentList.push($scope.studentfields)
					console.log(res)
				}
			);
		}
	})

	.controller('eventsController', function($scope, $http, EventsData, AttendanceData) {
		$scope.list = function() {}
		$scope.update = function() {}
		$scope.delete = function() {}
	})