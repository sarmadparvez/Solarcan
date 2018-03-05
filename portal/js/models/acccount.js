window.Account = Backbone.Model.extend({
    urlRoot:"../api/account",

    initialize: function () {
        this.validators = {};

        this.validators.annee_construction = _.bind(function (value) {
            return this.validateRequired(value);
        }, this);
    },

    validateRequired: function(value) {
        console.log('in validate required: ', value);
        return !_.isEmpty(value) ? {isValid: true} : {
            isValid: false,
            message: "This field is required"
        };
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
        "annee_construction":"",
        "occupant_depuis":"",
        "nombre_portes_total":"",
        "nombre_portes_achanger":"",
        "nombre_fenetres_total":"",
        "nombre_fenetres_achanger":"",
        "nombre_garage_total":"",
        "nombre_garage_achanger":"",
        "etat_de_proprietaire":"",
    }
});

/*window.WineCollection = Backbone.Collection.extend({
    model:Wine,
    url:"../api/wines"
});*/
