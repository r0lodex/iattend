var iattend = angular.module('iattend', ['ngRoute', 'angularModalService'])
	.run(function($rootScope, ModalService) {
		console.log('App Started!')

		// Default fields for Events
		$rootScope.sfields = function(ic, serial, name, matrix){
			this.ic = ic;
			this.serial_no = serial;
			this.fullname = name;
			this.matrix_no = matrix;
			this.student = true;
		}
		// Default fields for Events
		$rootScope.efields = function(name, desc, venue, date, time){
			this.name = name;
			this.descp = desc;
			this.venue = venue;
			this.day = date;
			this.time = time;
			this.event = true;
		}
		$rootScope.showModal = function(type, record) {
			ModalService.showModal({
				templateUrl: 'templates/modal.html',
				controller: "modalController",
				inputs: {
					type : type,
					currentRecord: record
				}
			}).then(function(modal) {
				modal.element.modal();
			})
		};
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

		$http.get('../php/router.php?student=true')
			.success(function(response) {
				deferred.resolve(response);
			}
		);

		return deferred.promise;
	})

	.factory('EventsData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?event=1')
			.success(function(response) {
				deferred.resolve(response);
			}
		);

		return deferred.promise;
	})

	.factory('AttendanceData', function($http, $q) {
		var deferred = $q.defer();

		$http.get('../php/router.php?attendance=1')
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

// -------------------------
// STUDENTS
	.controller('studentsController', function($rootScope, $scope, $http, StudentsData) {

		StudentsData.then(function(res) {
			$scope.studentList = res;
		});

		$scope.createStudent = function() {
			$scope.studentfields = new $rootScope.sfields($scope.ic, $scope.serial_no, $scope.fullname, $scope.matrix_no);

			console.log($scope.studentfields)

			$http.post('../php/router.php', $scope.studentfields)
				.success(function(res) {
					console.log(res)
					$scope.studentList.push($scope.studentfields)
				}
			);
		}
		$scope.delete = function(student) {
			var a = confirm('Confirm Delete?');
			if(a) {
				var del = $scope.studentList[student];
					del.student = true;
					del.delete = true;

				console.log(del)

				$http.post('../php/router.php', del)
					.success(function(res){
						$scope.studentList.splice(student,1)
						console.log(res)
					}
				);
			}
		}
	})

// -------------------------
// EVENTS
	.controller('eventsController', function($scope, $http, $rootScope, EventsData, AttendanceData) {
		EventsData.then(function(res) {
			$scope.eventList = res;
		});

		$scope.addEvent = function() {
			$scope.eventfields = new $rootScope.efields($scope.name, $scope.descp, $scope.venue, $scope.day, $scope.time)

			console.log($scope.eventfields);

			$http.post('../php/router.php', $scope.eventfields)
				.success(function(res) {
					console.log(res);
					$scope.eventList.push($scope.eventfields);
				}
			);
		};
	})

// -------------------------
// MODAL
	.controller('modalController', function($scope, $http, EventsData, StudentsData, currentRecord, type) {
		$scope.currS = {};
		$scope.type = type;

		if(type === 'student') {
			StudentsData.then(function(res) {
				$scope.currS = res[currentRecord];
			});
		}
		if(type == 'event') {
			EventsData.then(function(res) {
				$scope.currS = res[currentRecord];
			})
		}

		$scope.updateStudent = function(data) {
			data.student = true;
			$http.post('../php/router.php', data)
				.success(function(res) {
					console.log(data)
					console.log(res)
				}
			);
		}

		$scope.updateEvent = function(data) {
			data.event = true;
			$http.post('../php/router.php', data)
				.success(function(res) {
					console.log(data)
					console.log(res)
				}
			);
		}
	})