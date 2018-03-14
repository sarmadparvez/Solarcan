window.PortalContainerView = Backbone.View.extend({
    childViews: {}, //store child views objects in this
    cal_events: [
     /*   {
            id: 999,
            title: 'Test Event',
            start: '2018-02-16T16:00:00',
//            end: '2018-01-16T16:20:00'
        },*/
/*        {
            id: 999,
            title: 'Test Event',
            start: '2018-02-16',
            end: '2018-02-16'
        }*/
    ],
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
    
    events: {
        "click #saveToSugar": "saveToSugar",
    },

/*    events: {
        "click #book-appointment" : "bookAppointment"
    },*/

    api_call_sent: false, //attribute to lock multiple api calls

    initialize: function () {
        if (!window.sessionStorage.logged_in) {
            utils.checkLogin();
            return;
        }
        this.render();
        this.appendContactInfoView();
        this.appendAccountView();
        this.renderCalendar();
        pcself = this;
    },

    render: function () {
        $(this.el).html(this.template());
        return this;
    },
    
    saveToSugar: function() {
        this.api_call_sent = true;
        var contact_model = this.childViews.contactView.model,
            account_model = this.childViews.accountView.model;
        
        if (!this.validateContactModel() ||
            !this.validateContactPhone() ||
            !this.validateAccountModel() ||
            !this.validateCategory()) {
            return;
        }
        
        $.ajax({
            method: "POST",
            url: "api/saveInfoandAccount",
            dataType: 'json',
            data: {
                "contact_model" : contact_model.toJSON(),
                "account_model" : account_model.toJSON(),
                "partenaire_info": $('#partenaire_info').val()
            },
            success: _.bind(function(response) {
                console.log('in success');
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
                console.log('in complete function');
                this.api_call_sent = false;
            }, this)
        });
    },

    appendContactInfoView: function()
    {
        var contact = new Contact(),
            contactView = new ContactInfoView({model: contact});
        $(this.el).find("#contact-info").html(contactView.el);   
        this.childViews.contactView = contactView;
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
                if (!this.validateContactPhone() || !this.validateAccountModel()) {
                    return false;
                }
                console.log('in event click');
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
        if (!this.validateContactModel() || !this.validateCategory()) {
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
                'billing_address_postalcode' : contact_model.get('billing_address_postalcode'),
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
        eee = event;

        if (this.api_call_sent) {
            return false;
        }
        this.api_call_sent = true;
        var contact_model = this.childViews.contactView.model,
            account_model = this.childViews.accountView.model;
        console.log('in book appointment');
        $.ajax({
            method: "POST",
            url: "api/bookAppointment",
            dataType: 'json',
            data: {
                "meeting_id" : event.data.meeting_id,
                "postalcode" : contact_model.get('billing_address_postalcode'),
                "contact_id" : contact_model.get('id'), //when pronto will be integrated, contact id will be passed here as this contact
                // will be already in CRM, pronto will provide contact id that we will set in model
                "description" : $('#notes').val(),
                "financement" : $('#financement').prop('checked'),
                "contact_model" : contact_model.toJSON(),
                "account_model" : account_model.toJSON(),
                "partenaire_info": $('#partenaire_info').val()
            },
            success: _.bind(function(response) {
                console.log('in success');
                if (response.result) {
                    alert('Appointment successfully booked');
                    $('#dialog-form').dialog("close");
                    this.getAvailableAppointments();
                } else {
                    var error = JSON.parse(response.error.msg);
                    alert(error.error_message);
                }
            }, this),
            error: _.bind(function(error) {
                alert(error.statusText);
            }, this),
            complete: _.bind(function(){
                console.log('in complete function');
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
        if (_.isEmpty(contact_model.get('billing_address_postalcode'))) {
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
        } else if (!this.validateCategory()){
            validate = false;
        } else if (_.isEmpty(account_model.get('etat_de_proprietaire'))) {
            alert('Please select "Type de propritair"');
            validate = false;
        }
        return validate;
        /*var check = this.model.validateAll();
        if (check.isValid === false) {
            utils.displayValidationErrors(check.messages);
            this.validation_result = check
            return false;
        } else if (!_.isEmpty(this.validation_result)) {
            utils.removeValidationErrors(this.model);
            this.validation_result = null;
        }
        return true;*/
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
                msg += ' : ' + this.childViews.contactView.model.get('billing_address_postalcode');
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
    }
});
