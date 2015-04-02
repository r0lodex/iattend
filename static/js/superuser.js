angular.module('iattend')
	.run(function($rootScope, ModalService) {
		console.log('This is SuperUser!')
		// Default fields for Students
		$rootScope.ufields = function(username, password, fullname, email, phone){
			this.username = username;
			this.password = password;
			this.fullname = fullname;
			this.email = email;
			this.phone = phone;
			this.admin = true;
		};

		$rootScope.adminModal = function(type, record) {
			ModalService.showModal({
				templateUrl: 'templates/modal_admin.html',
				controller: "adminController",
				inputs: { currentRecord: record, type: type }
			}).then(function(modal) {
				modal.element.modal();
			})
		};
	})

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

	.controller('adminController', function($rootScope, $scope, $http, AdminData) {
		AdminData.then(function(res) {
			$scope.adminList = res;
		});
		$scope.createAdmin = function() {
			$scope.fields = new $rootScope.ufields($scope.username, $scope.password, $scope.fullname, $scope.email, $scope.phone);
			$http.post('../php/router.php', $scope.fields)
				.success(function(res) {
					console.log(res)
					$scope.adminList.push($scope.fields)
					$('#closeModalAdmin').trigger('click');
					alert('Administrator Added');
				}
			);
		};

		$scope.delete = function(admin) {
			var a = confirm('Confirm Delete?');
			if(a) {
				var del = $scope.adminList[admin];
					del.admin = true;
					del.delete = true;

				$http.post('../php/router.php', del)
					.success(function(res){
						$scope.adminList.splice(admin,1)
					}
				);
			}
		}

		$scope.lookupResult = []
		$scope.lookup = function(query) {

			$scope.show = false;
			$scope.searching = false;
			$scope.noresult = false;

			if ($.trim(query) != '') {
				$scope.searching = true;
				$http.get('../php/router.php?lookup='+query)
					.then(function(res) {
						if (res.data.length > 0) {
							$('#searching').hide();
							$scope.show = true;
							$scope.searching = false;
							$scope.lookupResult = res.data;
						} else {
							$scope.show = false;
							$scope.searching = false;
							$scope.noresult = true;
							setTimeout(function(){
								$scope.noresult = false;
							}, 10);
						}
					})
			}
		}
	})