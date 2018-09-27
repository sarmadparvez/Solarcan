({
    availableMeetings: null,
    selectedSlots: null,
    timeSlots: null,
    className: 'full-calendar tcenter',
    initialize: function (options) {
        this._super('initialize', [options]);
    },
    render: function () {
        this._super('render');
        var self = this;
        this.prepareTimeSlots();
        var slotEvents = this.prepareEvents();

        this.availableMeetings = app.data.createBeanCollection('Meetings');
        this.selectedSlots = [];

        this.$('#calendar').fullCalendar({
            locale: 'fr-ca',
            customButtons: {
                confirmButton: {
                    text: 'Confirmer',
                    click: function () {
                        if (!_.isEmpty(self.selectedSlots)) {
                            app.alert.show('meeting_confirm', {
                                level: 'confirmation',
                                title: 'Créer nouvelles rencontres',
                                messages: 'Cette action créera des nouvelles rencontres disponibles pour les plages horaires sélectionnées dans SugarCRM.',
                                autoClose: false,
                                onConfirm: function () {
                                    App.api.call('create', App.api.buildURL('Meetings/mass_create', null, null, {"max_num": -1}),
                                        {
                                            newMeetings: self.selectedSlots,
                                        },
                                        {
                                            success: _.bind(function (data) {
                                                app.alert.show('1', {
                                                    level: 'success',
                                                    messages: 'Rencontres créées avec succès',
                                                    autoClose: true
                                                });
                                                self.selectedSlots = [];
                                                var currentView = self.$('#calendar').fullCalendar('getView');
                                                self.fetchMeetings(currentView);
                                            }, self),
                                            error: _.bind(function (data) {
                                                app.alert.show('1', {
                                                    level: 'error',
                                                    messages: 'Erreur à la création des rencontres',
                                                    autoClose: true
                                                });
                                            }, self),
                                        });
                                },
                                onCancel: function () {
                                }
                            });
                        } else {
                            app.alert.show('1', {
                                level: 'error',
                                messages: 'Sélectionnez des nouvelles plages horaires',
                                autoClose: true
                            });
                        }
                    }
                },
                refreshButton: {
                    text: 'Rafraichir Événements',
                    click: function () {
                        self.selectedSlots = [];
                        var currentView = self.$('#calendar').fullCalendar('getView');
                        self.fetchMeetings(currentView);
                    }
                }
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'refreshButton, confirmButton'
            },
            buttonText: {
                today: 'Aujourd\'hui'
            },
            hiddenDays: [0],
            height: 340,
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            nowIndicator: true,
            slotLabelFormat: 'H:mm', // uppercase H for 24-hour clock
            timeFormat: 'H:mm',
            allDaySlot: false,
            agendaEventMinHeight: 5,
            defaultView: 'agendaWeek',
            snapOnSlots: false, // When dragging/resizing a event it doesn't snaps on the timeslot
            snapDuration: '00:05:00', // instead it does steps of 5 minutes
            defaultTimedEventDuration: '02:00:00',
            slots: self.timeSlots,
            events: slotEvents,
            eventRender: function (event, element, view) {

                var time = '';
                time += self.formatForDate(event.start.time()._data.hours);
                time += ":" + self.formatForDate(event.start.time()._data.minutes);
                time += ":" + self.formatForDate(event.start.time()._data.seconds);

                // make id a sugar compatible date
                // used when creating meetings to set date_start
                var id = self.formatForDate(event.start.year());
                id += '-' + self.formatForDate((Number(event.start.month()) + 1).toString());
                id += '-' + self.formatForDate(event.start.date());

                var meetingSlots = App.config.appointment_timeslots;
                if (event.start.day() == 6) {   // if saturday
                    if (time == meetingSlots.regular_case.AM2.start_time) {
                        time = meetingSlots.special_case.AM2.start_time;
                    } else if (time == meetingSlots.regular_case.PM1.start_time) {
                        time = meetingSlots.special_case.PM1.start_time;
                    } else if (time == meetingSlots.regular_case.PM2.start_time) {
                        time = meetingSlots.special_case.PM2.start_time;
                    }
                }

                // set slot name of current event
                var slotName = '';
                for (var i in meetingSlots.regular_case) {
                    if (time == meetingSlots.regular_case[i].start_time) {
                        slotName = i;
                    }
                }
                if (slotName == '') {
                    for (var i in meetingSlots.special_case) {
                        if (time == meetingSlots.special_case[i].start_time) {
                            slotName = i;
                        }
                    }
                }
                var renderCheckBox = self.isEventAhead(id, time);
                if (renderCheckBox == true) {
                    if (event.start.day() == 6) {
                        for (var i in meetingSlots.special_case) {
                            if (!meetingSlots.special_case[slotName]) {
                                // if this slot doesn't exist in config's saturday slots
                                renderCheckBox = false;
                            }
                        }
                    }
                }
                if (renderCheckBox == true) {
                    id += 'T' + time;
                    element.html('<input type="checkbox" id="new_' + id + '" name="' + slotName + '"/>');
                }
            },
            eventAfterAllRender: function(view) {
                // when we call fullCalendar('rerenderEvents') function
                // this function is also called after all re-rendering completes
                // but viewRender is not called again as it is a view not an event
                self.recheckSlotsOnNavigation();
            },
            viewRender: function (view, element) {
                // this function is called whenever view is changed
                // for e.g, navigating to next/previous or today view
                self.fetchMeetings(view);
            },
            eventClick: function (event, jsEvent, view) {
                var startDate = self.formatForDate(event.start.date());
                var startMonth = self.formatForDate((Number(event.start.month()) + 1).toString());
                var startYear = self.formatForDate(event.start.year());
                var fullDate = startYear + "-" + startMonth + "-" + startDate;

                var time = '';
                time += self.formatForDate(event.start.time()._data.hours);
                time += ":" + self.formatForDate(event.start.time()._data.minutes);
                time += ":" + self.formatForDate(event.start.time()._data.seconds);

                var meetingSlots = App.config.appointment_timeslots;
                if (event.start.day() == 6) {   // if saturday
                    if (time == meetingSlots.regular_case.AM2.start_time) {
                        time = meetingSlots.special_case.AM2.start_time;
                    } else if (time == meetingSlots.regular_case.PM1.start_time) {
                        time = meetingSlots.special_case.PM1.start_time;
                    } else if (time == meetingSlots.regular_case.PM2.start_time) {
                        time = meetingSlots.special_case.PM2.start_time;
                    }
                }

                var checkBox = document.getElementById("new_" + fullDate + "T" + time);
                var datetime = App.date(fullDate + " " + time, App.date.convertFormat("Y-m-d h:i:s"), false);
                var slot = {
                    name: 'Rencontres disponibles: ' + App.user.attributes.full_name,
                    status: 'disponible',
                    date_start: datetime.format(),
                    start_date: fullDate,
                    time: time
                };
                if (checkBox) {
                    if (checkBox.checked) {
                        if (!self.slotExists(slot)) {
                            slot.timeslot_name = checkBox.name;
                            self.selectedSlots.push(slot);
                        }
                    } else {
                        self.selectedSlots = _.reject(self.selectedSlots, function (el) {
                            return (el.start_date == slot.start_date && el.time == slot.time);
                        });
                    }
                }
            },
        });
    },
    fetchMeetings: function (view) {
        var self = this;
        var startDate = this.formatForDate(view.start.date());
        var startMonth = this.formatForDate((Number(view.start.month()) + 1).toString());
        var startYear = this.formatForDate(view.start.year());
        var filterStart = startYear + "-" + startMonth + "-" + startDate;

        var endDate = this.formatForDate(view.end.date());
        var endMonth = this.formatForDate((Number(view.end.month()) + 1).toString());
        var endYear = this.formatForDate(view.end.year());
        var filterEnd = endYear + "-" + endMonth + "-" + endDate;

        var filters = [
            {
                date_start: {$dateBetween: [filterStart, filterEnd]},
                created_by: app.user.attributes.id,
                //status: {"$not_equals": "disponible"}
                //"$or": [{"created_by": app.user.attributes.id}, {"assigned_user_id": app.user.attributes.id}, {"status": {"$not_equals": "disponible"}}]
                //"$or": [{"created_by": app.user.attributes.id}, {"assigned_user_id": app.user.attributes.id}, {"sales_rep_available_c": app.user.attributes.id}]
            }
        ];
        var request = this.availableMeetings.fetch(
            {
                limit: 30,
                filter: filters
            }
        );
        request.xhr.done(function () {
            self.$('#calendar').fullCalendar('rerenderEvents'); // Fix for issues #63879, #63880
            self.prepopulateCalendar();
        });
        var timeSlotsLabels = ['AM2', 'PM1', 'PM2', 'SOIR1', 'SOIR2'], i = 0, slot_elem = $('.fc-timeslots-axis');
        for (i = 0; i < slot_elem.length; i++) {
            $(slot_elem[i]).html(timeSlotsLabels[i]);
        }
    },
    formatForDate: function (string) {
        if (Number(string) < 10) {
            string = "0" + string;
        }
        return string;
    },
    prepopulateCalendar: function () {
        for (var i in this.availableMeetings.models) {
            dateStart = this.availableMeetings.models[i].attributes.date_start;

            var checkID = dateStart.slice(0, -6);   // remove time zone from end

            var checkBox = document.getElementById('new_' + checkID);
            if (checkBox) {
                checkBox.id = "old_" + checkID;
                checkBox.checked = true;
            }
        }
    },
    recheckSlotsOnNavigation: function () {
        for (var i in this.selectedSlots) {
            var slot = this.selectedSlots[i];
            var checkBox = document.getElementById("new_" + slot.start_date + "T" + slot.time);
            if (checkBox) {
                checkBox.checked = true;
            }
        }
    },
    prepareTimeSlots: function () {
        var meetingSlots = App.config.appointment_timeslots;

        this.timeSlots = [
            {
                start: meetingSlots.regular_case.AM2.start_time,
                end: meetingSlots.regular_case.AM2.end_time
            },
            {
                start: meetingSlots.regular_case.PM1.start_time,
                end: meetingSlots.regular_case.PM1.end_time
            },
            {
                start: meetingSlots.regular_case.PM2.start_time,
                end: meetingSlots.regular_case.PM2.end_time
            },
            {
                start: meetingSlots.regular_case.SOIR1.start_time,
                end: meetingSlots.regular_case.SOIR1.end_time
            },
            {
                start: meetingSlots.regular_case.SOIR2.start_time,
                end: meetingSlots.regular_case.SOIR2.end_time
            }
        ];
    },
    prepareEvents: function () {
        var slotEvents = [];
        for (var slot in this.timeSlots) {
            var event = this.timeSlots[slot];
            event.id = slot;
            event.title = "Rencontre disponible: " + App.user.attributes.full_name;
            slotEvents.push(event);
        }
        return slotEvents;
    },
    isEventAhead: function (eventDate, eventTime) {
        // get time difference between current date and event date that is being rendered
        var timeDiff = App.date().diff(eventDate + " " + eventTime, 'hours', true);
        if (timeDiff < 0) {
            // if current date/time is behind event date/time
            return true;
        }
        return false;
    },
    slotExists: function (slot) {
        return this.selectedSlots.some(function (el) {
            return (el.start_date == slot.start_date && el.time == slot.time);
        });
    }

})
