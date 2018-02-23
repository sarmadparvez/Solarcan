window.utils = {

    // Asynchronously load templates located in separate .html files
    loadTemplate: function(views, callback) {

        var deferreds = [];

        $.each(views, function(index, view) {
            if (window[view]) {
                deferreds.push($.get('tpl/' + view + '.html', function(data) {
                    window[view].prototype.template = _.template(data);
                }));
            } else {
                alert(view + " not found");
            }
        });

        $.when.apply(null, deferreds).done(callback);
    },

    uploadFile: function (file, callbackSuccess) {
        var self = this;
        var data = new FormData();
        data.append('file', file);
        $.ajax({
            url: 'api/upload.php',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            contentType: false
        })
        .done(function () {
            console.log(file.name + " uploaded successfully");
            callbackSuccess();
        })
        .fail(function () {
            self.showAlert('Error!', 'An error occurred while uploading ' + file.name, 'alert-error');
        });
    },

    displayValidationErrors: function (messages) {
        for (var key in messages) {
            if (messages.hasOwnProperty(key)) {
                this.addValidationError(key, messages[key]);
            }
        }
        this.showAlert('Warning!', 'Fix validation errors and try again', 'alert-warning');
    },

    removeValidationErrors: function (model) {
        /*for (var key in messages) {
            if (messages.hasOwnProperty(key)) {
                this.removeValidationError(key);
            }
        }*/
        for (var key in model.validators) {
            if(model.validators.hasOwnProperty(key)) {
                this.removeValidationError(key);
            }
        }
    },

    addValidationError: function (field, message) {
        var controlGroup = $('#' + field).parent().parent();
        controlGroup.addClass('error');
        $('.text-danger.align-middle', controlGroup.parent().parent()).html(message);
    },

    removeValidationError: function (field) {
        var controlGroup = $('#' + field).parent().parent();
        controlGroup.removeClass('error');
        $('.text-danger.align-middle', controlGroup.parent().parent()).html('');
    },

    showAlert: function(title, text, klass) {
        $('.alert').removeClass("alert-error alert-warning alert-success alert-info");
        $('.alert').addClass(klass);
        $('.alert').html('<strong>' + title + '</strong> ' + text);
        $('.alert').show();
    },

    hideAlert: function() {
        $('.alert').hide();
    },

    checkLogin: function(route)
    {
        console.log('in checkLogin in utils.js');
        $.ajax({
            method: "GET",
            url: "api/checkLogin",
            dataType: 'json',
            async: false,
            success: _.bind(function(response) {
                console.log('in successssss');
                if (response.result) {
                    window.sessionStorage.logged_in = true;
                    if (route) {
                        console.log('navigating to route');
                        window.location.replace(route);
                    } else {
                        window.location.replace("");
                    }
                }
            }, this)
        });
    }

};