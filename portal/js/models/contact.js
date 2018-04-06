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
        "consentement": false,
        "preferred_language_1": false,
        "preferred_language_2": false,
        "codecie_c" : "Solarcan"
    }
});

