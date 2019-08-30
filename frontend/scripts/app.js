"use strict";
var app = angular.module('app', ['ngRoute', 'ngResource'])

    .controller('fechaController', function ($scope) {
        $scope.CurrentDate = new Date();
    })

    .config(['$routeProvider', function ($routerProvider) {
        $routerProvider
            .when('/lista', {
                templateUrl: 'templates/list.html',
                controller: 'ListaController',
                controllerAs: 'Lista'
            })
            .when('/edit/:id', {
                templateUrl: 'templates/edit.html',
                controller: 'EditarController',
                controllerAs: 'Editar'
            })
            .when('/create/', {
                templateUrl: 'templates/create.html',
                controller: 'CrearController',
                controllerAs: 'Crear'
            })
            .when('/reporte/', {
                templateUrl: 'templates/reporte.html',
                controller: 'ReporteController',
                controllerAs: 'Reporte'
            })
            .when('/listaProv', {
                templateUrl: 'templates/listaProvincias.html',
                controller: 'ListaProvController',
                controllerAs: 'ListaProv'
            })
            /*.when('/view/:id', {
                templateUrl: 'templates/view.html',
                controller: 'VerController'
            })*/
            .otherwise({ redirectTo: '/inicio',
                templateUrl: 'templates/home.html',
            });
    }])

    .controller('ListaController', ['$scope', 'Empleados', '$route', function ($scope, Empleados, $route) {
        Empleados.get(function (data) {
            $scope.empleados = data.response;
        })

        $scope.remove = function (id) {
            Empleados.delete({ id: id }).$promise.then(function (data) {
                if (data.response) {
                    $route.reload();
                }
            })
        }
    }])

    .controller('ListaProvController', ['$scope', 'Provincias', '$route', function ($scope, Provincias, $route) {
        Provincias.get(function (data) {
            $scope.provincias = data.response;
        })

        $scope.remove = function (id) {
            Provincias.delete({ id: id }).$promise.then(function (data) {
                if (data.response) {
                    $route.reload();
                }
            })
        }
    }])

    .controller('CrearController', ['$scope', 'Empleados', 'Provincias', 'fileUpload', function ($scope, Empleados, Provincias, fileUpload) {
        Provincias.get(function (data) {
            $scope.provincias = data.response;
        })

        $scope.settings = {
            pageTitle: "Crear empleado nuevo",
            action: "Guardar"
        };

        $scope.archivo_model = {
            value: ''
        }

        $scope.empleado = {
            nombre_empleado: "",
            apellido_empleado: "",
            cedula_empleado: "",
            id_provincia: null,
            fecha_nacimiento_empleado: "",
            correo_empleado: "",
            observacion_empleado: "",
            foto_empleado: "",
            id_estado: "1",
            fecha_ingreso: "",
            cargo_empleado: "",
            departamento_empleado: "",
            id_provincia_laboral: null,
            sueldo_empleado: "",
            jornada_empleado: "SI",
            observacion_laboral: "",
        };

        $scope.submit = function () {
            var nombre_archivo = '';
            var archivo = $scope.archivo_model.value;

            if (archivo && archivo.name) {
                nombre_archivo = archivo.name.trim();
                nombre_archivo = nombre_archivo.replace(/ /g, '');
                $scope.empleado.foto_empleado = nombre_archivo;
            }
            console.log($scope.empleado);
            Empleados.save({ empleado: $scope.empleado }).$promise.then(function (data) {
                if (data.response) {
                    if (nombre_archivo !== '') {
                        var upload_url = "/../frontend/public/imagenes";
                        fileUpload.upload_file_To_url(archivo, upload_url);
                    }
                    angular.copy({}, $scope.empleado); //vaciar los datos uan vez insertados
                    $scope.settings.success = "El empleado ha sido creado correctamente!";
                    window.location = "#!/lista";
                }
            })
        }
    }])

    .controller('EditarController', ['$scope', 'Empleados', 'Provincias', '$routeParams', function ($scope, Empleados, Provincias, $routeParams) {
        $scope.settings = {
            pageTitle: "Editar empleado",
            action: "Editar"
        };

        var id = $routeParams.codigo_empleado;

        Empleados.get({ id: id }, function (data) {
            $scope.empleado = data.response;
        });

        $scope.submit = function () {
            Empleados.update({ empleado: $scope.empleado }, function (data) {
                $scope.settings.success = "El empleado ha sido editado correctamente!";
            });
        }
    }])

    .controller('BuscarCodController', ['$scope', function ($scope, $http) {
        /*var id = $routeParams.buscar;
        console.log(id);
        Empleados.get({ id: id }, function (data) {
            $scope.empleados = data.response;
        });*/
        /*console.log($scope.buscar);
        $scope.serach = function(){
            $http({
                method:"POST",
                url: 'templates/list.html',
                data:{buscar:$scope.buscar}
            }).success(function(data){
                $scope.empleados = data.response;
            })
        };*/

        /*$scope.remove = function (id) {
            Empleados.delete({ id: id }).$promise.then(function (data) {
                if (data.response) {
                    $route.reload();
                }
            })
        }*/
    }])

    //obtener valores json
    .factory('Empleados', ['$resource', function ($resource) {
        return $resource('http://localhost:88/angular/backend/empleado/:id', { id: "@_id" }, {
            update: { method: "PUT", params: { id: "@_id" } }
        })
    }])

    .factory('Reporte', ['$resource', function ($resource) {
        return $resource('http://localhost:88/angular/backend/empleado/reporte/', { id: "@_id" }, {
            update: { method: "PUT", params: { id: "@_id" } }
        })
    }])

    .factory('Regiones', ['$resource', function ($resource) {
        return $resource('http://localhost:88/angular/backend/region/:id', { id: "@_id" }, {
            update: { method: "PUT", params: { id: "@_id" } }
        })
    }])

    .factory('Provincias', ['$resource', function ($resource) {
        return $resource('http://localhost:88/angular/backend/provincia/:id', { id: "@_id" }, {
            update: { method: "PUT", params: { id: "@_id" } }
        })
    }])

    .factory('BuscarCodigo', ['$resource', function ($resource) {
        return $resource('http://localhost:88/angular/backend/empleado/buscarCodigo/:id', { id: "@_id" }, {
            update: { method: "PUT", params: { id: "@_id" } }
        })
    }])

    .factory('BuscarNombre', ['$resource', function ($resource) {
        return $resource('http://localhost:88/angular/backend/empleado/buscarNombre/:id', { id: "@_id" }, {
            update: { method: "PUT", params: { id: "@_id" } }
        })
    }])

    .factory('Imagenes', ['$resource', function ($resource) {
        return $resource('http://localhost:88/angular/backend/empleado/guardarImagen/', { id: "@_id" }, {
            update: { method: "PUT", params: { id: "@_id" } }
        })
    }])

    /*.controller('myCtrl', ['$scope', 'fileUpload', function ($scope, fileUpload) {
        $scope.uploadFile = function () {

            var file = $scope.myFile;
            console.log('file is ');
            console.dir(file);
            var uploadUrl = "/fileUpload";
            fileUpload.uploadFileToUrl(file, uploadUrl);
        };
    }]);*/

    /*$scope.uploadFile = function(element){
        var reader = new FileReader
    }*/

    /*app.config(['$httpProvider', function ($httpProvider) {

        $httpProvider.defaults.transformRequest = function (data) {
            if (undefined === data) return data;
            var formData = new FormData();
            angular.forEach(data, function (value, key) {
                if (value instanceof FileList) {
                    if (value.length === 1)
                        formData.append(key, value[0]);
                    else {
                        angular.foreach(value, function (file, index) {
                            formData.append(key + '_' + index, file);
                        });
                    }
                } else {
                    formData.append(key, value);
                }
            });
            return formData;
        };
        $httpProvider.defaults.headers.post['Content-Type'] = undefined;

    }]);*/

    /*.controller('namesCtrl', function ($scope) {
        $scope.orderByMe = function (x) {
            $scope.myOrderBy = x;
        }
    })*/

    .controller('TableFilterAppController', ['$scope', 'Empleados', function ($scope, Empleados) {
        Empleados.get(function (data) {
            $scope.sortType = 'firstName';
            $scope.sortReverse = false;
            $scope.searchQuery = '';
            //$scope.empleados = data.response;
        })
    }])

    .controller('ReporteController', ['$scope', 'Reporte', '$route', function ($scope, Reporte, $route) {
        Reporte.get(function (data) {
            $scope.reporte = data.response;
        })

        /*$scope.remove = function (id) {
            Reporte.delete({ id: id }).$promise.then(function (data) {
                if (data.response) {
                    $route.reload();
                }
            })
        }*/
    }])

    //validar moneda a nivel de controlador
    .controller('MonedaController', ['$scope', function ($scope) {
        $scope.regex = /^\d+(?:\.\d{0,2})$/;
    }])

    .controller('BotonesController', ['$scope', function ($scope) {
        $scope.visibilidad = false;
        
        $scope.cambiar = function(){
            $scope.visibilidad = true;
            console.log($scope.visibilidad);
        }
    }]);