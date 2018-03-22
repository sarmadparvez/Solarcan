window.Contact = Backbone.Model.extend({
    urlRoot:"api/contact",
    defaults:{
        "id" : null,
        "first_name":"",
        "last_name":"",
        "phone_home":"",
        "phone_mobile":"",
        "phone_work":"",
        "phone_other":"",
        "billing_address_street":"",
        "billing_address_city":"",
        "billing_address_postalcode":"",
        "billing_address_state":"",
        "primary_address_street":"",
        "primary_address_city":"",
        "primary_address_postalcode":"",
        "primary_address_state":"",
        "email":"",
        "consentement":"",
        "date_de_consentement_datestamp":"",
        "preferred_language_1":"",
        "preferred_language_2":"",
        "codecie_c" : "Solarcan"
    }
});

/*window.WineCollection = Backbone.Collection.extend({
    model:Wine,
    url:"../api/wines"
});*/
