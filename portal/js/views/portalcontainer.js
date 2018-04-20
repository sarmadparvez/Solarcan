window.PortalContainerView = Backbone.View.extend({
    childViews: {}, //store child views objects in this
    cal_events: [],
    timeslots: {
        'regular_case' : {
            'AM2' : 'T10:00:00',
            'PM1' : 'T13:30:00',
            'PM2' : 'T16:00:00',
            'SOIR1' : 'T18:30:00',
            'SOIR2' : 'T20:30:00'
        },
        'special_case' : {
            'Saturday' : {
                'AM2' : 'T09:30:00',
                'PM1' : 'T12:30:00',
                'PM2' : 'T15:00:00',       
            }
        }
    },

    account_fields: [
        'annee_construction',
        'nombre_portes_total',
        'nombre_fenetres_total',
        'nombre_garage_total',
        'nombre_portes_achanger',
        'nombre_fenetres_achanger',
        'nombre_garage_achanger',
        'occupant_depuis'
    ],

    boolean_fields : ['consentement', 'do_not_call'],

    events: {
        "click #saveToSugar": "saveToSugar",
        "keyup #primary_address_postalcode" : "formatPostalCode",

    },

    api_call_sent: false, //attribute to lock multiple api calls
    contact_id: null,

    initialize: function (options) {
        if (!_.isUndefined(options) &&
            !_.isEmpty(options.contact_id)) {
            this.contact_id = options.contact_id;
        }
        this.render();
        this.appendContactInfoView();
        this.appendAccountView();
        this.renderCalendar();
    },

    render: function () {
        $(this.el).html(this.template());
        return this;
    },

    formatPostalCode: function(evt)
    {
        var postalcode = evt.target.value;
        var contact_model = this.childViews.contactView.model;
        if (postalcode.length > 3) {
            postalcode = postalcode.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
            if (postalcode.length > 7) {
                postalcode = postalcode.replace(/\s+$/,"");
            }
            postalcode = postalcode.toUpperCase();
            $('#primary_address_postalcode').val(postalcode);
            contact_model.set('primary_address_postalcode', postalcode);
        }
    },
    
    saveToSugar: function() {
        this.api_call_sent = true;
        var contact_model = this.childViews.contactView.model,
            account_model = this.childViews.accountView.model;
        
        if (!this.validateContactModel() ||
            !this.validatePostalCode() ||
            !this.validateContactPhone() ||
            !this.validateAccountModel()) {
            return;
        }
        
        $.ajax({
            method: "POST",
            url: "api/saveInfoandAccount",
            dataType: 'json',
            data: {
                "contact_model" : contact_model.toJSON(),
                "account_model" : account_model.toJSON(),
                "partenaire_info": $('#partenaire_info').val(),
                "postalcode" : contact_model.get('primary_address_postalcode')
            },
            success: _.bind(function(response) {
                if (response.result) {
                    alert('Info and Batiment Saved Successfully');
                } else {
                    var error = JSON.parse(response.error.msg);
                    alert(error.error_message);
                }
            }, this),
            error: _.bind(function(error) {
                alert(error.statusText);
            }, this),
            complete: _.bind(function(){
                this.api_call_sent = false;
            }, this)
        });
    },

    validatePostalCode: function()
    {
        var contact_model = this.childViews.contactView.model,
            validate = true;
        if (!_.isEmpty(contact_model))
        {
            var postalcode = contact_model.get('primary_address_postalcode'),
                match = postalcode.match(/^[A-Z][0-9][A-Z] [0-9][A-Z][0-9]$/g);

            if (_.isArray(match) && !_.isEmpty(match.pop())) {
                return true;
            }
        }
        alert("Please input a valid Postal code in the format H1H 1H1");
        return false;
    },

    appendContactInfoView: function()
    {
        if (!_.isEmpty(this.contact_id)) {
            $.ajax({
                method: "POST",
                url: "api/contact",
                dataType: 'json',
                data: {
                    'id' : this.contact_id
                },
                success: _.bind(function(response) {
                    if (response.result) {
                        var contact = new Contact(response.records);
                        var contactView = new ContactInfoView({ model: contact });
                        
                        $(this.el).find("#contact-info").html(contactView.el);
                        this.childViews.contactView = contactView;
                        
                        for (var field in response.records) {
                            if (field == 'preferred_language') {
                                if (response.records[field] == 'francais') {
                                    $('input[name=preferred_language_1]').prop('checked', true);
                                    this.childViews.contactView.model.set('preferred_language_1', true);
                                } else {
                                    $('input[name=preferred_language_2]').prop('checked', true);
                                    this.childViews.contactView.model.set('preferred_language_2', true);
                                }
                            } else if(_.contains(this.boolean_fields, field) && response.records[field] == true) {
                                $('input[name='+field+']').prop('checked', true);
                            } else if (field == 'email') {
                                var emails = "";
                                for (var e in response.records[field]) {
                                    if (emails == "") {
                                        emails += response.records[field][e].email_address;
                                    } else {
                                        emails += "; " + response.records[field][e].email_address;
                                    }
                                }
                                $('input[name=' + field + ']').val(emails);
                            } else if ($('input[name=' + field + ']').length > 0) {
                                $('input[name=' + field + ']').val(response.records[field]);
                                if (_.contains(this.account_fields, field)) {
                                    this.childViews.accountView.model.set(field, response.records[field]);
                                }
                            } else if ($('select[name=' + field + ']').length > 0) {
                                $('select[name=' + field + ']').val(response.records[field]);
                                if (field == 'etat_de_proprietaire') {
                                    this.childViews.accountView.model.set('etat_de_proprietaire', response.records[field]);
                                }
                            }
                        }
                        
                    } else {
                        var error = JSON.parse(response.error.msg);
                        alert(error.error_message);
                    }
                }, this),
                error: _.bind(function(error) {
                    if (error.status != 401) {
                        alert(error.statusText);
                    }
                }, this)
            });
        } else {
            var contact = new Contact();
            var contactView = new ContactInfoView({model: contact});
            $(this.el).find("#contact-info").html(contactView.el);
            this.childViews.contactView = contactView;
        }
    },

    appendAccountView: function()
    {
        var account = new Account(),
            accountView = new AccountView({model: account});
        $(this.el).find("#batiment").html(accountView.el);
        this.childViews.accountView = accountView;
    },

    renderCalendar: function()
    {
        $(this.el).find('#full-calendar').fullCalendar({
            header: {
                left: 'prev,next today, myCustomButton',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            //defaultDate: '2018-02-12',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            defaultView: 'basicWeek',
            events: this.cal_events,
            customButtons: {
                myCustomButton: {
                    text: 'available appointments',
                    click: _.bind(this.getAvailableAppointments, this)
                }
            },
            eventClick:  _.bind(function(event, jsEvent, view) {
                if (!this.validateContactPhone() || !this.validateAccountModel() || !this.validatePostalCode()) {
                    return false;
                }
                var dialog = $( "#dialog-form" ).dialog({
                    autoOpen: false,
                    //height: 400,
                    //width: 350,
                    modal: true
                });
                dialog.dialog( "open" );
                //bind click event for book button
                $( "#book-appointment").unbind( "click" );
                $('#book-appointment').click(event, _.bind(this.bookAppointment, this));
            }, this)
        });
    },

    /**
    * Get available appointments from SugarCRM for given postal code
    */
    getAvailableAppointments: function()
    {
        if (!this.validateContactModel() || !this.validateCategory() || !this.validatePostalCode()) {
            return;
        }
        var contact_model = this.childViews.contactView.model,
            account_model = this.childViews.accountView.model;
        if (_.isEmpty(contact_model)) {
            alert('Unable to get Contact Info. Please refresh the page and try again');
        } else if (_.isEmpty(account_model)) {
            alert('Unable to get Batiment Info. Please refresh the page and try again');
        }
        //prepare categories
        var categories = this.getCategories();

        //make api call to server for getting Available meetings from CRM
        $.ajax({
            method: "POST",
            url: "api/getAvailableAppointments",
            dataType: 'json',
            data: {
                'billing_address_postalcode' : contact_model.get('primary_address_postalcode'),
                'preferred_language_1' : contact_model.get('preferred_language_1'),
                'preferred_language_2' : contact_model.get('preferred_language_2'),
                'codecie_c' : contact_model.get('codecie_c'),
                'categories' : categories
            },
            success: _.bind(function(response) {
                if (response.result) {
                    this.available_appointments = response.records;
                    this.populateCalendar();
                } else {
                    var error = JSON.parse(response.error.msg);
                    alert(error.error_message);
                }
            }, this),
            error: _.bind(function(error) {
                alert(error.statusText);
            }, this)
        });
    },

    bookAppointment: function(event)
    {
        if (this.api_call_sent) {
            return false;
        }
        this.api_call_sent = true;
        var contact_model = this.childViews.contactView.model,
            account_model = this.childViews.accountView.model;
        $.ajax({
            method: "POST",
            url: "api/bookAppointment",
            dataType: 'json',
            data: {
                "meeting_id" : event.data.meeting_id,
                "postalcode" : contact_model.get('primary_address_postalcode'),
                "contact_id" : contact_model.get('id'), //when pronto will be integrated, contact id will be passed here as this contact
                // will be already in CRM, pronto will provide contact id that we will set in model
                "description" : $('#notes').val(),
                "financement" : $('#financement').prop('checked'),
                "contact_model" : contact_model.toJSON(),
                "account_model" : account_model.toJSON(),
                "partenaire_info": $('#partenaire_info').val()
            },
            success: _.bind(function(response) {
                if (response.result) {
                    $('#dialog-form').dialog("close");
                    alert('Appointment successfully booked');
                    this.remove();
                    $('#dialog-form').remove()
                    app.navigate("notification", true);
                    //this.getAvailableAppointments();
                } else {
                    var error = JSON.parse(response.error.msg);
                    alert(error.error_message);
                }
            }, this),
            error: _.bind(function(error) {
                alert(error.statusText);
            }, this),
            complete: _.bind(function(){
                this.api_call_sent = false;
            }, this)
        });
    },

    /**
    * get product categories
    */
    getCategories: function()
    {
        var categories = [],
            account_model = this.childViews.accountView.model,
            nombre_fenetres_achanger = parseInt(account_model.get('nombre_fenetres_achanger')) || 0,
            nombre_garage_achanger = parseInt(account_model.get('nombre_garage_achanger')) || 0,
            nombre_portes_achanger = parseInt(account_model.get('nombre_portes_achanger')) || 0;

        if (nombre_fenetres_achanger > 0) {
            categories.push('qualified_windows_rep_c');
        }
        if (nombre_garage_achanger > 0) {
            categories.push('qualified_garage_rep_c');
        }
        if (nombre_portes_achanger > 0) {
            categories.push('qualified_doors_rep_c');
        }
        return categories;
    },

    /**
    * Validate contact model for required info before making call to SugarCRM
    */
    validateContactModel: function()
    {
        var contact_model = this.childViews.contactView.model;
        if (_.isEmpty(contact_model.get('primary_address_postalcode'))) {
            alert('Please enter Postal Code for Contact');
            return false;
        } else if (!contact_model.get('preferred_language_1') && !contact_model.get('preferred_language_2')) {
            alert('Please select at least one language');
            return false;
        }
        return true;
    },

    /**
    * Validate Account model
    */
    validateAccountModel: function()
    {
        var account_model = this.childViews.accountView.model,
            validate = true;

        if (_.isEmpty(account_model.get('annee_construction'))) {
            alert('Please enter "Anne de construction"');
            validate = false;
        } else if (_.isEmpty(account_model.get('occupant_depuis'))) {
            alert('Please enter "Occupation depuis"');
            validate = false;
        } else if (_.isEmpty(account_model.get('etat_de_proprietaire'))) {
            alert('Please select "Type de propritair"');
            validate = false;
        }
        return validate;
    },

    validateContactPhone : function()
    {
        var contact_model = this.childViews.contactView.model;
        if (!_.isEmpty(contact_model) && _.isEmpty(contact_model.get('phone_home'))
            && _.isEmpty(contact_model.get('phone_mobile')) && _.isEmpty(contact_model.get('phone_work'))
             && _.isEmpty(contact_model.get('phone_other'))) {
            alert("Please input atleast one phone number for the Contact");
            return false;
        }
        if (!this.validatePhoneNumber()) {
            return false;
        }
        return true;
    },

    /**
    * check if at least door,windows or garage is set in Account model
    */
    validateCategory: function()
    {
        var account_model = this.childViews.accountView.model,
            nombre_fenetres_achanger = parseInt(account_model.get('nombre_fenetres_achanger')) || 0,
            nombre_garage_achanger = parseInt(account_model.get('nombre_garage_achanger')) || 0,
            nombre_portes_achanger = parseInt(account_model.get('nombre_portes_achanger')) || 0;
        
        if (nombre_fenetres_achanger < 1 && nombre_garage_achanger < 1 && nombre_portes_achanger < 1){
            alert('Please select at least one from "Porte à changer", "Fenetre à changer" and "Garage à changer"');
            return false;
        }
        return true;
    },

    /**
    * Populate appointments on calendar
    */
    populateCalendar: function()
    {
        // check if appointments found
        if (!(this.available_appointments.length > 0)) {
            var msg = 'No available appointments found for Postal Code';
            if (!_.isEmpty(this.childViews.contactView) && !_.isEmpty(this.childViews.contactView.model)) {
                msg += ' : ' + this.childViews.contactView.model.get('primary_address_postalcode');
                this.cal_events = [];
                this.refreshCalenderEvents();
            }
            alert(msg);
            return;
        }
        this.prepareCalendarEvents();
        this.refreshCalenderEvents();
    },

    /**
    * Refresh events on calendar
    */
    refreshCalenderEvents: function()
    {
        $(this.el).find('#full-calendar').fullCalendar( 'removeEvents');
        $(this.el).find('#full-calendar').fullCalendar( 'addEventSource', this.cal_events);    
        $(this.el).find('#full-calendar').fullCalendar( 'rerenderEvents' );
        $(this.el).find('#full-calendar').fullCalendar( 'today' );
    },

    /**
    * Prepare events to be shown on calendar
    */
    prepareCalendarEvents: function()
    {
        var events = [], i = 0;
        _.each(this.available_appointments, function(appointment) {
            var obj = {};
            obj.title = appointment.timeslot + ' Availble: ' + appointment.available_count ;
            if (appointment.dayname == 'Saturday') {
                obj.start = appointment.dateonly +
                this.timeslots.special_case[appointment.dayname][appointment.timeslot];
            } else {
                obj.start = appointment.dateonly +
                this.timeslots.regular_case[appointment.timeslot];
            }
            obj.available_count = appointment.available_count;
            obj.url = 'javascript:void(0)';
            obj.meeting_id = appointment.meeting_id;
            events.push(obj);
        }, this);
        this.cal_events = events;
    },

    /**
    * Validate phone numbers
    */
    validatePhoneNumber: function()
    {
        var contact_model = this.childViews.contactView.model;
        var phone_home = contact_model.get('phone_home');
        var phone_mobile = contact_model.get('phone_mobile');
        var phone_work = contact_model.get('phone_work');
        var phone_other = contact_model.get('phone_other');
        if (this.validateNumber(phone_home) ||
            this.validateNumber(phone_mobile) ||
            this.validateNumber(phone_work) ||
            this.validateNumber(phone_other)) {
            return true;
        }
        return false;
    },

    validateNumber: function(phone_number)
    {
        var regex = /^\d{10}$/ ;
        if (!phone_number) {
            return false;
        }
        if (!regex.test(phone_number)) 
        {
            alert('Please input a valid 10 digit phone number. Phone number should only contain digits!');
            return false;
        }
        return true;
    }
});
