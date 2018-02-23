window.SignupView = Backbone.View.extend({

    validation_result: null,

    initialize: function () {
        this.render();
        signupself = this;
    },

    render: function () {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    },

    events:{
        "change" : "change",
        "click #create-user":"createUser"
    },

    /**
    * Binding view to model
    */
    change: function (event) {
        // Remove any existing alert message
        utils.hideAlert();

        // Apply the change to the model
        var target = event.target;
        var change = {};
        change[target.name] = target.value;
        this.model.set(change);

        // Run validation rule (if any) on changed item
/*        var check = this.model.validateItem(target.id);
        if (check.isValid === false) {
            utils.addValidationError(target.id, check.message);
        } else {
            utils.removeValidationError(target.id);
        }*/
    },

    validateModel: function()
    {
        var self = this;
        var check = this.model.validateAll();
        if (check.isValid === false) {
            utils.displayValidationErrors(check.messages);
            this.validation_result = check
            return false;
        } else if (!_.isEmpty(this.validation_result)) {
            utils.removeValidationErrors(this.model);
            this.validation_result = null;
        }
        return true;
    },

/*    createUser:function (event) {
        app.navigate("user/create", true);
        return false;
    },*/

    createUser:function () {
        if (! this.validateModel()) {
            return;
        }
        console.log('in create user of signup.js');

        var self = this;
        this.model.save(null, {
            success: function (model) {
                self.render();
                if (model.attributes.error == 422) {
                    var error_message = model.attributes.error_message;
                    var msg = error_message.substring(error_message.lastIndexOf("[")+1, error_message.lastIndexOf("]"));
                    var msgObject = JSON.parse(msg);
                    alert(msgObject.error_message);
                } else {
                    alert("Signup Successful");
                    app.navigate("", true);
                }
            },
            error: function () {
                alert("Error");
            }
        });

        return false;
    },

});