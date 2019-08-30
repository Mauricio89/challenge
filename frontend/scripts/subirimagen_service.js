app.service('fileUpload', function ($http) {
    this.upload_file_To_url = function (file, upload_url) {
        var fd = new FormData();

        fd.append('file', file);

        $http.post(upload_url, fd, {
            transformRequest: angular.identity,
            headers: {
                'Content-Type': undefined
            }
        })
            .then(function (response) {
                console.log(response);
                //return response.data.response;
            });
    }
});