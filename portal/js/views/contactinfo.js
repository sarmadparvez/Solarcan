window.ContactInfoView = Backbone.View.extend({

    events:{
        "change"        : "change",
        "change input[type=checkbox]" : "checkboxChange"
    },

    checkboxChange: function(event)
    {
        console.log('checkbox changed');
        eee = event;
    },

    initialize: function () {
        this.render();
        ciself = this;
     //   console.log('in contact info view');
    },

    render: function () {
        console.log('in render of contact info view');
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    },

    change: function (event) {

        // Apply the change to the model
        var target = event.target;
        var change = {};
        if (target.type == 'checkbox') {
            change[target.name] = target.checked;
        } else {
            change[target.name] = target.value;
        }
        this.model.set(change);

/*        // Run validation rule (if any) on changed item
        var check = this.model.validateItem(target.id);
        if (check.isValid === false) {
            utils.addValidationError(target.id, check.message);
        } else {
            utils.removeValidationError(target.id);
        }*/
    },

});
