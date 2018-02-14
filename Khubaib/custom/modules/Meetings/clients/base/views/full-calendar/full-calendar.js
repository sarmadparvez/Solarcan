({
    availableMeetings: null,
    timeSlots: null,
    className: 'full-calendar tcenter',
    render: function () {
        this._super('render');

        var self = this;
        this.prepareTimeSlots();
        var slotEvents = this.prepareEvents();

        this.availableMeetings = app.data.createBeanCollection('Meetings');

        this.$('#calendar').fullCalendar({
            customButtons: {
                confirmButton: {
                    text: 'Confirm',
                    click: function () {
                        app.alert.show('meeting_confirm', {
                            level: 'confirmation',
                            title: 'Create New Meetings',
                            messages: 'This action will create new Available meetings of selected time slots in SugarCRM.',
                            autoClose: false,
                            onConfirm: function () {
                                var createMeetings = [];
                                $("#calendar").find('input[type=checkbox]').each(function () {
                                    if (this.checked && (this.id).substr(0, 4) == 'new_') {

                                        var datetime = (this.id).substr(4);
                                        datetime = datetime.replace("T", " ");
                                        datetime = App.date(datetime, App.date.convertFormat("Y-m-d h:i:s"), false);
                                        var meeting = {
                                            name: 'Available Meetings',
                                            date_start: datetime.format(),
                                            status: 'disponible',
                                            assigned_user_id: app.user.attributes.id,
                                            timeslot_name: this.name
                                        };
                                        createMeetings.push(meeting);
                                    }
                                });
                                if (!_.isEmpty(createMeetings)) {
                                    App.api.call('create', App.api.buildURL('Meetings/mass_create'),
                                            {
                                                newMeetings: createMeetings,
                                            },
                                            {
                                                success: _.bind(function (data) {
                                                    app.alert.show('1', {
                                                        level: 'success',
                                                        messages: 'Meetings created successfully',
                                                        autoClose: true
                                                    });
                                                    self.$('#calendar').fullCalendar('rerenderEvents');
                                                }, self),
                                                error: _.bind(function (data) {
                                                    app.alert.show('1', {
                                                        level: 'error',
                                                        messages: 'Failed to create Meetings',
                                                        autoClose: true
                                                    });
                                                }, self),
                                            });
                                } else {
                                    app.alert.show('1', {
                                        level: 'error',
                                        messages: 'Please select New Meeting slots',
                                        autoClose: true
                                    });
                                }
                            },
                            onCancel: function () {
                            }
                        });
                    }
                },
                refreshButton: {
                    text: 'Refresh Events',
                    click: function () {
                        $('#calendar').fullCalendar('rerenderEvents');
                    }
                }
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'refreshButton, confirmButton, agendaWeek'
            },
            hiddenDays: [0],
            height: 350,
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            nowIndicator: true,
            slotLabelFormat: 'H:mm', // uppercase H for 24-hour clock
            timeFormat: 'H:mm',
            allDaySlot: false,
            agendaEventMinHeight: 20,
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
                var renderCheckBox = self.renderCheckBox(id, time);
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
            eventAfterAllRender: function (view) {
                var startDate = self.formatForDate(view.start.date());
                var startMonth = self.formatForDate((Number(view.start.month()) + 1).toString());
                var startYear = self.formatForDate(view.start.year());
                var filterStart = startYear + "-" + startMonth + "-" + startDate;

                var endDate = self.formatForDate(view.end.date());
                var endMonth = self.formatForDate((Number(view.end.month()) + 1).toString());
                var endYear = self.formatForDate(view.end.year());
                var filterEnd = endYear + "-" + endMonth + "-" + endDate;

                var filters = [
                    {
                        status: 'disponible',
                        assigned_user_id: app.user.attributes.id,
                        date_start: {$dateBetween: [filterStart, filterEnd]}
                    }
                ];
                var request = self.availableMeetings.fetch({
                    filter: filters
                });
                request.xhr.done(function () {
                    self.prepopulateCalendar();
                });
                var timeSlotsLabels = ['AM2', 'PM1', 'PM2', 'SOIR1', 'SOIR2'], i = 0, slot_elem = $('.fc-timeslots-axis');
                for (i = 0; i < slot_elem.length; i++) {
                    $(slot_elem[i]).html(timeSlotsLabels[i]);
                }
            },
        });
    },
    formatForDate: function (string) {
        if (Number(string) < 10) {
            string = "0" + string;
        }
        return string;
    },
    prepopulateCalendar: function () {
        var self = this;
        console.log("Meetings Fetched: ", self.availableMeetings.models.length);
        for (var i in self.availableMeetings.models) {
            dateStart = self.availableMeetings.models[i].attributes.date_start;

            var checkID = dateStart.slice(0, -6);   // remove time zone from end

            var checkBox = document.getElementById('new_' + checkID);
            if (checkBox) {
                checkBox.id = "old_" + checkID;
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
            event.title = "Available Appointment";
            slotEvents.push(event);
        }
        return slotEvents;
    },
    renderCheckBox: function (eventDate, eventTime) {
        var current_date = (new Date()).toISOString().substring(0, 10);
        var current_time = (new Date()).toISOString().substring(11, 18);

        var broken_current_date = current_date.split('-');
        var broken_current_time = current_time.split(':');

        var broken_event_date = eventDate.split('-');
        var broken_event_time = eventTime.split(':');

        var timeZoneOffset = ((new Date()).getTimezoneOffset()) / 60;

        if (Number(broken_event_date[0]) > Number(broken_current_date[0])) {        // year greater
            return true;
        } else if (Number(broken_event_date[0]) == Number(broken_current_date[0])) {    // year equal
            if (Number(broken_event_date[1]) > Number(broken_current_date[1])) {    // month greater
                return true;
            } else if (Number(broken_event_date[1]) == Number(broken_current_date[1])) {    // month equal
                if (Number(broken_event_date[2]) > Number(broken_current_date[2])) {   // day
                    return true;
                } else if (Number(broken_event_date[2]) == Number(broken_current_date[2])) {    // if same day then check time
                    if (Number(broken_event_time[0]) > ((Number(broken_current_time[0]) - timeZoneOffset) % 24)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

})
