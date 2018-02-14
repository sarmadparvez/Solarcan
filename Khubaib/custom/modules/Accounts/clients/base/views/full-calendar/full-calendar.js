({
    popTemplate : [
    '<div class="popover" style="max-width:600px;" >',
    '<div class="arrow"></div>',
    '<div class="popover-header">',
    '<button id="closepopover" type="button" class="close" aria-hidden="true">&times;</button>',
    '<h3 class="popover-title"></h3>',
    '</div>',
    '<div class="popover-content"></div>',
    '</div>'].join(''),

    select_all: false,

    /**
    * @override
    */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.context.on('calendar:search:fire', _.bind(this.searchClicked, this), this);
        this.model.on('change:product_type_c', _.bind(this.setViewVisibility, this), this);
        this.model.on('change:sites_search change:position_c change:start_date_search change:end_date_search',
            _.bind(this.setCalendarVisibility, this),this);
        this.context.on('calendar:start_placement:fire', _.bind(this.startPlacement, this), this);
        this.context.on('placement:select_all:fire', _.bind(this.selectAllClicked, this), this);
        // bind events of Hold/Reserve/Save Draft buttons
        this.context.on('placement:holdReservation:fire', _.bind(this.holdReservation, this), this);
        this.context.on('placement:reserveReservation:fire', _.bind(this.reserveReservation, this), this);
        this.context.on('placement:saveDraftReservation:fire', _.bind(this.saveDraftReservation, this), this);
        this.context.on('placement:createReservation:fire', _.bind(this.createReservation, this), this);
        // bind event for Recheck Invnetory button
        this.context.on('button:recheck_inventory:click', _.bind(this.recheckInventory, this), this);
        this.context.on('setPlacementBtnVisibility', _.bind(this.setPlacementBtnVisibility, this), this);
    },

    /**
     * Function: setPlacementBtnVisibility
     *
     * Set visibility of start placement button
     */
    setPlacementBtnVisibility: function()
    {
        // check if calendar is displayed
        if (this.isVisible() && this.getAvailableSites().length > 0) {
            var btn  = this.getFieldFromParentView('start_placement_btn');
            if (!_.isEmpty(btn)) {
                btn.show();
                if (this.placement_btn_enabled) {
                    btn.$el.find('a').removeClass('disabled');
                } else {
                    btn.$el.find('a').addClass('disabled');
                }

            }
        }
    },

    /**
     * Function: recheckInventory
     *
     * Recheck inventory for Draft Reservations
     */
    recheckInventory: function()
    {
        if (this.model.get('product_type_c') != 'Limited Inventory') {
            app.alert.show('error', {
                level: 'error',
                messages: app.lang.get('LBL_ACTION_INV_TYP_ERR', this.module),
                autoClose: false
            });
            return;
        }
        var url = app.api.buildURL('INRES_Placement', 'recheckInventory/' + this.model.get('id'));
        app.api.call('read', url, null, {
            success: _.bind(function (data) {
                if (_.isEmpty(data.records)) {
                    app.alert.show('error', {
                        level: 'error',
                        messages: app.lang.get('LBL_NO_DRAFT_FOUND', this.module),
                        autoClose: false
                    });
                } else {
                    this.calendar_data = data;
                    this.processRecheckInventoryData();
                }
            }, this),
            error: _.bind(function(error) {
                app.alert.show('error', {
                    level: 'error',
                    messages: error.message
                });
            }, this),
        });
    },

    /**
     * Function: processRecheckInventoryData
     *
     * process data returned by :module/recheckInventory/:placement_id api
     */
    processRecheckInventoryData: function()
    {
        this.select_all = false;
        this.show();
        this.$('#confirmation_view').hide();
        this.prepareTabs(_.keys(this.calendar_data.sites));
        // handling tabs click
        this.$('.nav.nav-tabs a').click(_.bind(this.tabClicked, this, true));

        var events = this.getCalendarEventsForRecheckInventory();
        this.populateCalendarwithData(events);
        this.context.trigger('showInvSearchPanel');
        this.setStartPlacementButtonState(true);
    },

    /**
     * Function: getCalendarEventsForRecheckInventory
     *
     * prepare calendar events to be shown on calendar for Recheck Inventory Actions
     */
    getCalendarEventsForRecheckInventory: function()
    {
        var active_site = this.getActiveTab(),
            calendar_events = [],
            position_list = app.lang.getAppListStrings('position_list'),
            i = 0,
            day_data = {},
            cal_event = [],
            ir = null;

        if (!_.isEmpty(this.calendar_data.sites[active_site])) {
            // loop through ids for active site, that are the IR records in this.calendar_data.records array
            for (i = 0; i < this.calendar_data.sites[active_site].length; i++) {
                ir = this.calendar_data.records[this.calendar_data.sites[active_site][i]];
                if (!_.isEmpty(ir)) {
                    _.each(ir.dates, function(date_data, date) {
                    // a single day data
                    day_data  = {
                        pos: ir.position_c,
                        available: date_data.available,
                        booked: date_data.booked,
                        daily_quantity: date_data.daily_quantity,
                    };

                    if (calendar_events.length > 0) {
                        var prev = calendar_events[calendar_events.length-1];
                        // if the event is continuing i.e we need to show in same color and don't break the line
                        if (((prev['evt_start_day_data']['available'] > 0 && date_data.available > 0) || 
                            (prev['evt_start_day_data']['available'] == date_data.available)) 
                            && prev['ir_id'] == ir.ir_id) {
                            calendar_events[calendar_events.length-1]['end'] = moment(date).add(1, 'd').format('YYYY-MM-DD');
                            calendar_events[calendar_events.length-1]['available'] = date_data.available;
                            // if daily_quantity is 0 , it means data not found in inventory
                            calendar_events[calendar_events.length-1]['day_data'][date] = day_data;
                            return;
                        }
                    }
                    cal_event = {
                        ir_id : ir.ir_id,
                        site: active_site,
                        pos: ir.position_c,
                        title: position_list[ir.position_c],
                        start: date,
                        end: moment(date).add(1, 'd').format('YYYY-MM-DD'),
                        evt_start_day_data: {
                            available: date_data.available
                        },
                        day_data: {},
                    };
                    if (!_.isEmpty(date_data.color)) {
                        cal_event.color = date_data.color;
                    }
                    cal_event['day_data'][date] = day_data;

                    // greyed out where available is 0
                    if (date_data.available == 0) {
                        cal_event.color = 'grey';
                    }
                    calendar_events.push(cal_event);
                }, this);
                }
            }
        }
        return calendar_events;
    },

    /**
    * @function holdReservation
    * initiate creation of reservations with status = Hold
    */
    holdReservation: function()
    {
        this.reservation_status = 'Hold';
        this.initiateCreateReservation();
    },

    /**
    * @function reserveReservation
    * initiate creation of reservations with status = Reserve
    */
    reserveReservation: function()
    {
        this.reservation_status = 'Reserved';
        this.initiateCreateReservation();
    },

    /**
    * @function saveDraftReservation
    * initiate creation of reservations with status = Save Draft
    */
    saveDraftReservation: function()
    {
        this.reservation_status = 'Draft';
        this.initiateCreateReservation();
    },

    /**
    * @function createReservation
    * send request for creating reservations
    */
    initiateCreateReservation: function()
    {
        var data = [],
            obj = {};
        // prepare data
        _.each(this.res_collection.models, function (model) {
            if (model.get('select') == true) {
                obj = _.pick(model.attributes,
                    'site',
                    'position',
                    'start_date_c',
                    'end_date_c',
                    'inventory_id'
                );
                if (!_.isUndefined(model.attributes.ir_id)) {
                    obj = _.extend(obj, {
                        'ir_id' : model.attributes.ir_id,
                        'ir_name' : model.attributes.ir_name
                    });
                }
                data.push(obj);
            }
        });
        if (data.length > 0) {
            this.ir_data = data;
            if (this.context.get('layout') != 'record') {
                this.context.trigger('click:savePlacement');
            } else if (!_.isEmpty(this.calendar_data.records)) {
                // recheck inventory case in record view
                this.updateReservation();
            } else {
                // regular search calendar case in record view
                this.createReservation();
            }
        } else {
            app.alert.show('placement_warning', {
                level: 'warning',
                title: app.lang.get('LBL_PLACEMENT_NO_RECORD_SELECTED'),
                autoclose: true
            });
        }
    },

    /**
    * @function updateReservation
    * update Reservations status after recheck inventory
    */
    updateReservation: function()
    {
        var url = app.api.buildURL(this.module, 'updateReservations'),
            params = {
                'ir_data' : this.ir_data,
                'reservation_status' : this.reservation_status
            };
         app.alert.show('updating_ir', {
            level: 'process',
            title: app.lang.get('LBL_UPDATING_PLACEMENT_RESERVATIONS_MSG', this.module)
        });
        app.api.call('create', url, params, {
            success: _.bind(function (response) {
                app.alert.dismiss('updating_ir');
                // if some records are skipped due to daily quantity limit reached
                if (!_.isUndefined(response.skip_count) && response.skip_count > 0 ) {
                    var msg = app.lang.get('LBL_UPDATE_PLACEMENT_RESERVATION_PARTIAL', 'INRES_Placement', {
                        skipped_count : response.skip_count
                    });
                    app.alert.show('warning', {
                        level: 'warning',
                        messages: msg
                    });
                } else {
                    // case when all records are successfull updated
                    app.alert.show('success', {
                        level: 'success',
                        messages: app.lang.get('LBL_SUCCESS_UPDATE_PLACEMENT_RESERVATION', this.module),
                        autoClose: true
                    });
                }
                // reload Placement Reservation subpanel data
                if (!_.isEmpty(this.context) && this.context.get('layout') == 'record') {
                    this.context.trigger('reloadSubpanelData', 'inres_placement_inres_inventory_reservation_1');
                    //hide inventory search panel
                    this.context.trigger('hideInvSearchPanel');
                }
            }, this),
            error: _.bind(function (error) {
                app.alert.show('error',
                        {
                            level: 'error',
                            messages: error.message,
                            autoClose: false
                        });
            }, this),
            complete: _.bind(function () {
                // after the reservations are created, hid start placement button, dispose confirmation
                // tab custom list views
                app.alert.dismiss('updating_ir');
                if (!_.isEmpty(this.context)) {
                    this.context.trigger('calendar:placementCreation:completed');
                    this.hide();
                }
                // hide calendar
                if (!_.isEmpty(this.context) && this.context.get('layout') == 'record') {
                    var start_placement_btn = this.getFieldFromParentView('start_placement_btn');
                    if (!_.isEmpty(start_placement_btn)) {
                        start_placement_btn.hide();
                    }
                }

            }, this)
        });           
    },

    /**
    * @function createReservation
    * create Reservations
    */
    createReservation: function()
    {
        var url = app.api.buildURL(this.module, 'startPlacement/' + this.model.get('id')),
            params = {
                'ir_data' : this.ir_data,
                'reservation_status' : this.reservation_status
            };
        app.alert.show('creating_ir', {
            level: 'process',
            title: app.lang.get('LBL_CREATING_PLACEMENT_RESERVATIONS_MSG')
        });
        app.api.call('create', url, params, {
            success: _.bind(function (response) {
                app.alert.dismiss('creating_ir');
                app.alert.show('success', {
                    level: 'success',
                    messages: app.lang.get('LBL_SUCCESS_CREATE_PLACEMENT_RESERVATION'),
                    autoClose: true
                });
                // reload Placement Reservation subpanel data
                if (!_.isEmpty(this.context) && this.context.get('layout') == 'record') {
                    this.context.trigger('reloadSubpanelData', 'inres_placement_inres_inventory_reservation_1');
                }
                // reload placement subpanel in DTS
                this.reloadSubpanelData('wdst_digital_support_ticket_inres_placement_2');
            }, this),
            error: _.bind(function (error) {
                app.alert.show('error',
                        {
                            level: 'error',
                            messages: error.message,
                            autoClose: false
                        });
            }, this),
            complete: _.bind(function () {
                // after the reservations are created, hid start placement button, dispose confirmation
                // tab custom list views
                app.alert.dismiss('creating_ir');
                if (!_.isEmpty(this.context)) {
                    this.context.trigger('calendar:placementCreation:completed');
                    this.hide();
                }
                // hide calendar
                if (!_.isEmpty(this.context) && this.context.get('layout') == 'record') {
                    var start_placement_btn = this.getFieldFromParentView('start_placement_btn');
                    if (!_.isEmpty(start_placement_btn)) {
                        start_placement_btn.hide();
                    }
                    var record_view = this.getParentView('record');
                    if (!_.isEmpty(record_view)) {
                        // finally save the parent model if its record view
                        record_view.saveClicked();
                    }
                }

            }, this)
        });
    },

    /**
     * Function: reloadSubpanelData
     *
     * reload Placement Reservation subpanel data
     */
    reloadSubpanelData: function (linkName) {
        // reload subpanel data
        var context = this.context || app.controller.context;
        var placementResSubpanel = _.find(context.children, function (child) {
            return child.get('isSubpanel') && child.get('link') == linkName
        });

        if (!_.isNull(placementResSubpanel) && !_.isUndefined(placementResSubpanel)) {
            var subPanel = placementResSubpanel.get('collection')
                    || placementResSubpanel.attributes.collection;
            subPanel.fetch({relate: true});
        }
    },

    /**
    * @function getParentView
    * get parent record/create view
    */
    getParentView : function(name)
    {
        return _.find(this.layout.layout._components, function(component) {
            return component.name == name;
        });
    },

    /**
    * @function setCalendarVisibility
    * show/hide calendar
    */
    setCalendarVisibility: function()
    {
        this.$('#calendar-tabs').html('');
        this.$('#calendar').fullCalendar('destroy');
        var start_placement_btn = this.getFieldFromParentView('start_placement_btn');
        if (!_.isEmpty(start_placement_btn)) {
            start_placement_btn.hide();
        }
        this.hide();
    },


    /**
    * @function setViewVisibility
    * show/hide view based on placement type
    */
    setViewVisibility: function()
    {
        if (this.model.get('product_type_c') == 'Limited Inventory') {
            this.show();
        } else {
            this.hide();
        }
    },

    /**
    * @function searchClicked
    * Display calendar when search button is clicked
    */
    searchClicked: function()
    {
        // validate search fields
        var isValid = this.validateSearchFields();
        if (!isValid) {
            return;
        }
        this.select_all = false;
        this.show();
        this.$('#confirmation_view').hide();
        this.prepareTabs();
        // handling tabs click
        this.$('.nav.nav-tabs a').click(_.bind(this.tabClicked, this, false));
        this.getData();
    },

    /**
    * @function getData
    * get data for calendar
    */
    getData: function()
    {
        var params = {
                start_date: this.model.get('start_date_search'),
                end_date : this.model.get('end_date_search'),
                sites: JSON.stringify(this.model.get('sites_search')),
                positions: JSON.stringify(this.model.get('position_c'))
            },
            url = app.api.buildURL('INRES_Placement', 'getCalendarData', {}, params);

        app.api.call('read', url, null, {
            success: _.bind(function (data) {
                this.calendar_data = data;
                var events = this.getCalendarEventsForSite();
                this.populateCalendarwithData(events);
                this.setStartPlacementButtonState();
            }, this),
            error: _.bind(function(error) {
                app.alert.show('error', {
                        level: 'error',
                        messages: error.message
                });
            }, this),
        });
    },

    /**
    * @function getCalendarEventsForSite
    * get calendar events for a site
    */
    getCalendarEventsForSite: function(site)
    {
        var active_site = site || this.getActiveTab(),
            calendar_events = [],
            position_list = app.lang.getAppListStrings('position_list'),
            positions = this.model.get('position_c'),
            i = 0,
            data = this.calendar_data,
            day_data = {},
            cal_event = [];
        if (!_.isEmpty(data[active_site])) {
            // loop through site,position
            _.each(data[active_site], function(pos_data, pos) {
                // loop through site,position,dates
                _.each(pos_data['dates'], function(date_data, date) {
                    // a single day data
                    day_data  = {
                        pos: pos,
                        available: date_data.available,
                        booked: date_data.booked,
                        daily_quantity: date_data.daily_quantity,
                    };
                    if (calendar_events.length > 0) {
                        var prev = calendar_events[calendar_events.length-1];
                        // if the event is continuing i.e we need to show in same color and don't break the line
                        if (((prev['evt_start_day_data']['available'] > 0 && date_data.available > 0) || 
                            (prev['evt_start_day_data']['available'] == date_data.available)) 
                            && prev['pos'] == pos) {
                            calendar_events[calendar_events.length-1]['end'] = moment(date).add(1, 'd').format('YYYY-MM-DD');
                            calendar_events[calendar_events.length-1]['available'] = date_data.available;
                            // if daily_quantity is 0 , it means data not found in inventory
                            calendar_events[calendar_events.length-1]['day_data'][date] = day_data;
                            return;
                        }
                    }
                    cal_event = {
                        site: active_site,
                        pos: pos,
                        title: position_list[pos],
                        start: date,
                        end: moment(date).add(1, 'd').format('YYYY-MM-DD'),
                        evt_start_day_data: {
                            available: date_data.available
                        },
                        day_data: {},
                    };
                    if (!_.isEmpty(date_data.color)) {
                        cal_event.color = date_data.color;
                    }
                    cal_event['day_data'][date] = day_data;

                    // greyed out where available is 0
                    if (date_data.available == 0) {
                        cal_event.color = 'grey';
                    }
                    calendar_events.push(cal_event);
                }, this);
            }, this);
        }
        // populate remaining positions which are not found in inventory

        for (i = 0; i< positions.length; i++) {
            if (_.isEmpty(data[active_site]) || _.isEmpty(data[active_site][positions[i]])) {
                calendar_events.push({
                    title: position_list[positions[i]],
                    start: this.model.get('start_date_search'),
                    end: moment(this.model.get('end_date_search')).add(1, 'd').format('YYYY-MM-DD'),
                    color: 'grey',
                    not_found_inventory: true,
                    site: active_site,
                    pos: positions[i]
                });
            }
        }
        return calendar_events;
    },

    /**
    * @function populateCalendarwithData
    * show data on calendar
    */
    populateCalendarwithData: function(calendar_events)
    {
        this.calendar_events = calendar_events;
        // show data on calendar
        this.$('#calendar').show();
        this.$('#calendar').fullCalendar('destroy');
        var params = {
                header: {
                left: 'month listYear',
                center: 'title',
                right : 'today prev,next',
            },
            buttonText: {
                list: 'Year'
            },
            eventLimit: true, // allow "more" link when too many events
            events: calendar_events,
            dayRender: _.bind(this.dayRender, this)
        };
        if (!_.isEmpty(calendar_events[0])) {
            params = _.extend(params, {defaultDate : calendar_events[0].start})
        }
        this.$('#calendar').fullCalendar(params);
    },

    /**
    * @function setStartPlacementButtonState
    * show and enable/disable Start Placement button based on the calendar data
    */
    setStartPlacementButtonState: function(recheck_inv)
    {
        var sites = [],
            positions = this.model.get('position_c'),
            start_placement_btn = this.getFieldFromParentView('start_placement_btn'),
            i = 0,
            j = 0,
            enable_start_placement = false;
        // get available sites
        sites = this.getAvailableSites();

        // if function is called for recheck inventory
        if (recheck_inv) {
            var record = null;
            for (i=0; i < sites.length; i++) {
                record = _.find(this.calendar_data.records, function(record) {
                    return record.site_c == sites[i] && record.not_available == false;
                });
                if (!_.isEmpty(record)) {
                    enable_start_placement = true;
                    break;
                }
            }
        } else {
            // if regular search is clicked
            for (i=0; i < sites.length; i++) {
                for (j = 0; j < positions.length; j++) {
                    if (!_.isEmpty(this.calendar_data[sites[i]]) && 
                        !_.isEmpty(this.calendar_data[sites[i]][positions[j]])) {
                        if (!this.calendar_data[sites[i]][positions[j]]['not_available']) {
                            enable_start_placement = true;
                            break;
                        }
                    }
                }
                // if we ve found one complete interval, no need to iterate further
                // we will now enable the start placement btn
                if (enable_start_placement) {
                    break;
                }
            }
        }


        if (!_.isEmpty(start_placement_btn)) {
            start_placement_btn.show();
            if (enable_start_placement) {
                this.placement_btn_enabled = true;
                start_placement_btn.$el.find('a').removeClass('disabled');
            } else {
                this.placement_btn_enabled = false;
                start_placement_btn.$el.find('a').addClass('disabled');
            }
        }
    },

    /**
    * @function getAvailableSites
    * get array of tabs/sits that are currently showing
    */
    getAvailableSites: function()
    {
        var sites = [];
        // loop through all tabs/sites and prepare full interval array
        _.each(this.$(this.$('#calendar-tabs')).find('li'), function(ele){
            if ($(ele).attr('data-value') != 'confirmation') {
                sites.push($(ele).attr('data-value'));
            }
        }, this);
        return sites;
    },

    /**
    * @function getFieldFromParentView
    * get field from the parent view (create or record)
    */
    getFieldFromParentView: function(name)
    {
        var parent_view = _.find(this.layout.layout._components, function(component) {
            return component.name == 'create' || component.name == 'record'
        }),
        field = null;
        if (!_.isEmpty(parent_view)) {
            field = parent_view.getField(name);
        }
        return field;

    },

    /**
    * @function dayRender
    * on mouse over show data in popover
    */
    dayRender: function(date, cell)
    {
        myCell = cell;
        var positions = [],
            i = 0,
            position_list = app.lang.getAppListStrings('position_list'),
            html = '',
            obj = {};
        this.$(cell.hover(_.bind(function(){
            html = '';
            for (i=0; i<this.calendar_events.length; i++) {
                // because the event and date is +1 day the actual end data
                if (date.format() == this.calendar_events[i]['end']) {
                    continue;
                }
                if (this.calendar_events[i]['start'] <= date.format() && this.calendar_events[i]['end'] >= date.format()) {
                    html+= '<u><b>' + this.calendar_events[i]['title'] + '</u></b><br/>';
                    if (_.isUndefined(this.calendar_events[i]['not_found_inventory'])) {
                        html+= 'Daily Quantity: ' + this.calendar_events[i]['day_data'][date.format()]['daily_quantity'] + '<br/>';
                        html+= 'Available: ' + this.calendar_events[i]['day_data'][date.format()]['available'] + '<br/>';
                        html+= 'Booked: ' + this.calendar_events[i]['day_data'][date.format()]['booked'] + '<br/>';
                    } else {
                        html+= 'Daily Quantity: 0' + '<br/>';
                        html+= 'Available: 0' + '<br/>';
                        html+= 'Booked: 0' + '<br/>';
                    }
                }
            }
            if (!_.isEmpty(html)) {
                obj = {
                    title: date.format(),
                    template: this.popTemplate,
                    placement: 'right',
                    content: html,
                    html: 'true',
                    container: 'body',
                    trigger: 'hover',
                };
                
                if (this.$(cell).next().length == 0) {
                    obj.placement = 'left';
                }
                this.$(cell).popover(obj).popover('show');
            }
        }, this)));
    },

    /**
    * @function getActiveTab
    * get active tab/site value
    */
    getActiveTab: function()
    {
        return this.$(this.$('#calendar-tabs').find('.active')).attr('data-value');
    },

    /**
    * @function validateSearchFields
    * search fields validation
    */
    validateSearchFields: function() {
        app.alert.dismiss('search_validation_err');
        if (_.isEmpty(this.model.get('sites_search')) || _.isEmpty(this.model.get('position_c')) ||
            _.isEmpty(this.model.get('start_date_search')) || _.isEmpty(this.model.get('end_date_search'))) {
            app.alert.show('search_validation_err', {
                level: 'error',
                autoClose: false,
                messages: app.lang.get('LBL_SEARCH_VALIDATION_ERR', this.module),
            });
            return false;
        }
        // user can select maximum of 5 positions
        if (this.model.get('position_c').length > 5) {
            app.alert.show('search_validation_err', {
                level: 'error',
                autoClose: false,
                messages: app.lang.get('LBL_MAX_POSITION_ERR'),
            });
            return false;   
        }

        // start and end date should not be in past
        if (moment().diff(this.model.get('start_date_search'), 'days') > 0 ||
            moment().diff(this.model.get('end_date_search'), 'days') > 0) {
            // date is in past
            app.alert.show('search_validation_err', {
                level: 'error',
                autoClose: false,
                messages: app.lang.get('LBL_SEARCH_DATE_PAST_ERR', this.module),
            });
            return false;
        }

        // end date should be after start date
        if (moment(this.model.get('end_date_search')).isBefore(this.model.get('start_date_search'))) {
            app.alert.show('search_validation_err', {
                level: 'error',
                autoClose: false,
                messages: app.lang.get('LBL_SEARCH_END_DATE_PAST_ERR', this.module),
            });
            return false;           
        }
        return true;
    },

    /**
    * @function prepareTabs
    * create tabs for each site
    */
    prepareTabs: function(sites)
    {
        var sites = sites || this.model.get('sites_search'),
            site_list = app.lang.getAppListStrings('site_list');
        this.$('#calendar-tabs').html('');
        _.each(sites, function(site) {
            this.$('#calendar-tabs').append(
                '<li data-value ="'+site+'"><a role="tab" >' + site_list[site] + '<span class="fa fa-times"> </span></a></li>'
            );
        }, this);
        //set first tab as active
        if (this.$('#calendar-tabs').find('li').length > 0) {
            this.$(this.$('#calendar-tabs').find('li')[0]).addClass('active');
        }
    },

    /**
    * @function tabClicked
    * called when a tab is clicked/removed
    */
    tabClicked: function(recheck_inv, e)
    {
        var events = null;
        e.preventDefault();
        // if cross icon is clicked then remove the tab
        if ($(e.target).hasClass('fa fa-times')) {
            // remove the tab if this is not the last tab
            if (!(this.$('#calendar-tabs').find('li').length == 1)) {
                $(e.target).parent().parent().remove();
                // if the removed tab is confirmation tab, dispose confirmation list views
                if ($(e.target).parent().parent('li').attr('data-value') == 'confirmation') {
                    this.context.trigger('calendar:placementCreation:completed');
                    this.$('#confirmation_view').hide()
                }
                // if the tab which is going to be removed is the active tab, make 1st tab as active
                if ($(e.target).parent().parent('li').hasClass('active')) {
                    this.$(this.$('#calendar-tabs').find('li')[0]).addClass('active');
                    if (this.$(this.$('#calendar-tabs').find('li')[0]).attr('data-value') != 'confirmation') {
                        var events = this.getCalendarEventsForSiteCommon(recheck_inv);
                        this.populateCalendarwithData(events);
                        this.setStartPlacementButtonState(recheck_inv);
                    } else {
                        // if only confirmation tab is left on the view , hide calendar and show confirmation view
                        this.$('#calendar').hide()
                        this.$('#confirmation_view').show();
                    }
                } else {    
                    this.setStartPlacementButtonState(recheck_inv);
                }
            }
        } else {
            // if tab is clicked
            $(e.target).tab('show');
            // if clicked tab is not the confirmation tab
            if ($(e.target).parent('li').attr('data-value') != 'confirmation') {
                this.$('#confirmation_view').hide();
                var events = this.getCalendarEventsForSiteCommon(recheck_inv);
                this.populateCalendarwithData(events);
            } else {
                this.$('#calendar').hide()
                this.$('#confirmation_view').show();
            }
        }
    },

    /**
    * @function getCalendarEventsForSiteCommon
    *
    * get calendar events based on the action i.e Regular search calendar or recheck inventory
    */
    getCalendarEventsForSiteCommon: function(recheck_inv)
    {
        return recheck_inv ? this.getCalendarEventsForRecheckInventory() : this.getCalendarEventsForSite();
    },

    /**
    * @function startPlacement
    *
    * called when a Start Placement button is clicked
    * initiates start placement functionality
    */
    startPlacement: function()
    {
        var recheck_inv  = false; // will track if this is the regular search calendar or recheck inv calendar
        // hide calendar
        this.$('#calendar').hide();
        this.$('#confirmation_view').show();
        // return if confirmation tab already exist
        if (this.$(this.$('#calendar-tabs').find('[data-value=confirmation]')).length > 0) {
            // make confirmation tab active
            if (this.$('#calendar-tabs').find('.active').attr('data-value') != 'confirmation') {
                this.$('#calendar-tabs').find('.active').removeClass('active');
                this.$(this.$('#calendar-tabs').find('[data-value=confirmation]')).addClass('active');
            }
            return;
        }
        if (!_.isEmpty(this.calendar_data.records)) {
            recheck_inv = true;
            this.createCollectionForDraft();
        } else {
            this.createCollection();
        }
        this.$('#calendar-tabs').find('.active').removeClass('active');
        this.$('#calendar-tabs').append(
            '<li data-value =confirmation class = "active"><a role="tab" >' + app.lang.get('LBL_CONFIRMATION', this.module) + '<span class="fa fa-times"> </span></a></li>'
        );
        this.$('.nav.nav-tabs a').off('click');
        this.$('.nav.nav-tabs a').click(_.bind(this.tabClicked, this, recheck_inv));
        this.initiateConfirmationListViews(recheck_inv);

    },

    /**
    * @function initiateConfirmationListViews
    *
    * make objects of potential-reservation-list view for each position and render them
    */
    initiateConfirmationListViews: function(recheck_inv)
    {
        var positions = recheck_inv ? this.calendar_data.positions : this.model.get('position_c'),
            j = 0,
            placeholder_element = '',
            position_view = null,
            position_list = app.lang.getAppListStrings('position_list');
        for (j = 0; j < positions.length; j++) {
            placeholder_element = document.createElement('div');
            this.$('#confirmation_list_view').append(placeholder_element);
            position_view = app.view.createView({
                context: this.context,
                name: 'potential-reservation-list',
                layout: this.layout,
                module: 'INRES_Placement'
            });
            position_view.current_position = positions[j];
            position_view.translated_position = position_list[positions[j]];
            position_view.collection = this.res_collection;
            position_view.setElement(placeholder_element);
            position_view.render();
        }   
    },

    /**
    * @function createCollectionForDraft
    *
    * create collection from calendar data, for recheck inventory (Draft Reservations)
    */
    createCollectionForDraft: function()
    {
        var sites = this.getAvailableSites(),
            i = 0,
            j = 0,
            formatted_interval = null;
        this.res_collection = app.data.createBeanCollection('INRES_Inventory_Reservation');
        _.each(this.calendar_data.records, function(record) {
            if (sites.indexOf(record.site_c) < 0) {
                return;
            }
            // if internval is fully available
            if (!record.not_available) {
                // convert db format to user format
                formatted_interval = app.date(record.ir_start_date).format(
                        app.date.convertFormat(app.user.getPreference('datepref'))
                    )  + ' - ' + app.date(record.ir_end_date).format(
                        app.date.convertFormat(app.user.getPreference('datepref'))
                    );
                var m = app.data.createBean('INRES_Inventory_Reservation', {
                    'site' : record.site_c,
                    'position': record.position_c,
                    'start_date_c': record.ir_start_date,
                    'end_date_c': record.ir_end_date,
                    'interval_available' : formatted_interval,
                    'not_available' : false,
                    'select' : true,
                    'ir_id' : record.ir_id,
                    'inventory_id' : record.inv_id,
                    'ir_name' : record.ir_name
                });
            } else {
                var m = app.data.createBean('INRES_Inventory_Reservation', {
                    'site' : record.site_c,
                    'position': record.position_c,
                    'interval_available' : ' - ',
                    'not_available' : true,
                    'select' : false
                });
            }
            this.res_collection.push(m);
        }, this);
    },

    /**
    * @function startPlacement
    *
    * create collection from calendar data
    */
    createCollection: function()
    {
        var sites = this.getAvailableSites(),
            i = 0,
            j = 0,
            positions = this.model.get('position_c'),
            formatted_interval = null;
        this.res_collection = app.data.createBeanCollection('INRES_Inventory_Reservation');
        for (i=0; i < sites.length; i++) {
            for (j = 0; j < positions.length; j++) {
                // if internval is fully available
                if (
                    !_.isEmpty(this.calendar_data[sites[i]]) &&
                    !_.isEmpty(this.calendar_data[sites[i]][positions[j]]) &&
                    !this.calendar_data[sites[i]][positions[j]]['not_available']
                    ) {
                    if (!_.isEmpty(this.model.get('start_date_search')) &&
                        !_.isEmpty(this.model.get('end_date_search'))) {
                        // convert db format to user format
                        formatted_interval = app.date(this.model.get('start_date_search')).format(
                                app.date.convertFormat(app.user.getPreference('datepref'))
                            )  + ' - ' + app.date(this.model.get('end_date_search')).format(
                                app.date.convertFormat(app.user.getPreference('datepref'))
                            );
                    } else {
                        formatted_interval = ' - ';
                    }
                    var m = app.data.createBean('INRES_Inventory_Reservation', {
                        'site' : sites[i],
                        'position': positions[j],
                        'start_date_c': this.model.get('start_date_search'),
                        'end_date_c': this.model.get('end_date_search'),
                        'interval_available' : formatted_interval,
                        'not_available' : false,
                        'select' : true,
                        'inventory_id' : this.calendar_data[sites[i]][positions[j]]['inventory_id']
                    });
                } else {
                    var m = app.data.createBean('INRES_Inventory_Reservation', {
                        'site' : sites[i],
                        'position': positions[j],
                        'interval_available' : ' - ',
                        'not_available' : true,
                        'select' : false
                    });
                }
                this.res_collection.push(m);
            }
        }
    },

    /**
    * @function selectAllClicked
    *
    * Select/De Select all record in placement confrimation list views
    */
    selectAllClicked: function(a, b ,c)
    {
        _.each(this.res_collection.models, function(model) {
            if (!model.get('not_available')) {
                model.set('select', this.select_all);
            }
        }, this);
        this.select_all = !this.select_all;
    },

    /**
     * @Override
     */
    _dispose: function() {
        this.model.off(
            'change:product_type_c change:sites_search change:position_c change:start_date_search change:end_date_search',
            null,
            this
        );
        this.context.off('calendar:search:fire', null, this);
        this.context.off('calendar:start_placement:fire', null, this);
        this.context.off('placement:select_all:fire', null, this);
        this.context.off('placement:holdReservation:fire', null, this);
        this.context.off('placement:reserveReservation:fire', null, this);
        this.context.off('placement:saveDraftReservation:fire', null, this);
        this.context.off('placement:createReservation:fire', null, this);
        this.context.off('button:recheck_inventory:click', null, this);
        this.context.off('setPlacementBtnVisibility', null, this);
        this._super('_dispose');
    }
})