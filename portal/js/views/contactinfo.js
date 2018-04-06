window.ContactInfoView = Backbone.View.extend({
    
    events:{
        "change"        : "change"
    },

    initialize: function () {
        this.render();
    },

    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    },

    change: function (event) {

        // Apply the change to the model
        var target = event.target;
        var change = {};
        if (target.type == 'checkbox') {
            if (target.checked == false) {
                change[target.name] =  false;
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
