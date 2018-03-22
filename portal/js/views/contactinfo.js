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
        console.log('model values: ', this.model.get('first_name'));
        this.render();
        ciself = this;
     //   console.log('in contact info view');
    },

    render: function () {
        console.log('in render of contact info view: ', this.model.toJSON());
        this.$el.html(this.template(this.model.toJSON()));
        // console.log('el in contactinfo.js: ', this.el);
        return this;
    },

    change: function (event) {

        // Apply the change to the model
        var target = event.target;
        var change = {};
        if (target.type == 'checkbox') {
            if (target.checked == false) {
                change[target.name] = "";
            } else {
                change[target.name] = target.checked;
            }
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
