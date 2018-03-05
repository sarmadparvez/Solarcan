window.User = Backbone.Model.extend({
    urlRoot:"api/user",

    initialize: function () {
        this.validators = {};

        this.validators.noagent = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);

        this.validators.nocallgen = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);

        this.validators.notp = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);

        this.validators.nom = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);

        this.validators.prenom = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);

        this.validators.team = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);

        this.validators.password = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);

        this.validators.passwordconfirm = _.bind(function (value) {

            return value == this.get('password') ? {isValid: true} : {
                isValid: false,
                message: "Password does not match"
            };
        }, this);
    },

    /**
    * Modify the api url before model makes api call
    */
/*    sync : function(method, model, options){
        if(method=='read'){
            options.url = model.url() + '/' + model.get('noagent'); 
        }
        return Backbone.sync(method, model, options);
    },*/

    validateRequired: function(value) {
        return !_.isEmpty(value) ? {isValid: true} : {
            isValid: false,
            message: "This field is required"
        };
    },

    validateItem: function (key) {
        return (this.validators[key]) ? this.validators[key](this.get(key)) : {isValid: true};
    },

    // TODO: Implement Backbone's standard validate() method instead.
    validateAll: function () {

        var messages = {};

        for (var key in this.validators) {
            if(this.validators.hasOwnProperty(key)) {
                var check = this.validators[key](this.get(key));
                if (check.isValid === false) {
                    messages[key] = check.message;
                }
            }
        }

        return _.size(messages) > 0 ? {isValid: false, messages: messages} : {isValid: true};
    },

    defaults:{
        "id" : null,
        "noagent":"",
        "nocallgen":"",
        "notp":"",
        "nom":"",
        "prenom":"",
        "team":"",
        "password" : "",
        "passwordconfirm" : ""
    }
});

/*window.WineCollection = Backbone.Collection.extend({
    model:Wine,
    url:"../api/wines"
});*/