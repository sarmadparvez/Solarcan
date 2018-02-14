/**
 * @class View.Views.Base.PortalConfigView
 * @alias SUGAR.App.view.views.BasePortalConfigView
 * @extends View.View
 */
({
    events: {
        'click a[name=cancel_button]': '_cancel',
        'click a[name=save_button]': '_save',
    },
    saveCallCompleted: true,

    initialize: function(options)
    {
        this._super('initialize', [options]);
        pcself = this;
    },

    /**
     * Function: _getFieldsValues
     *
     * @return array of all fields values
     */
    _getFieldsValues: function () {
        var self = this,
            fieldData = {};
        _.each(self.meta.panels, function (panel) {
            _.each(panel, function (fieldsArray) {
                _.each(fieldsArray, function (fields) {
                    _.each(fields, function (field) {
                        fieldName = field.name;
                        if (typeof (self.model.get(fieldName)) !== 'undefined') {
                            fieldData[fieldName] = self.model.get(fieldName);
                        }
                    });
                });
            });
        });
        return fieldData;
    },

    /**
     * Function: _save
     *
     * Click handler for save action.
     * generate api call for saving data into config
     */
    _save: function () {
        // Validate fields
        if (!this.validateFields()) {
            return false;
        }
        if (this.saveCallCompleted == false) {
            return;
        }
        this.saveCallCompleted = false;
        var self = this;
        this._getFieldsValues();
        var params = {
            data: this._getFieldsValues(),
        },
        url = app.api.buildURL('save_appointment_config', null, null, params);

        app.alert.show('saving_portal_config', {
            level: 'process',
            title: app.lang.get('LBL_PORTAL_CONFIG_SAVING'),
            autoClose: false,
        });
        app.api.call('create', url, null, {
            success: function (serverData) {
                if (serverData) {
                    app.alert.show('success', {
                        level: 'success',
                        autoClose: true,
                        messages: app.lang.get('LBL_SAVED'),
                    });
                }
            },
            error: function (error) {
                app.alert.show('portal_config_save_error', {
                    level: 'error',
                    autoClose: true,
                    messages: error.message,
                });
            },
            complete: function () {
                self.saveCallCompleted = true;
                app.alert.dismiss('saving_portal_config');
            },
        });
    },

    /**
     * Function: _cancel
     *
     * Click handler for cancle button.
     * close the view and go back
     */
    _cancel: function () {
        app.router.goBack();
    },
    /**
     * For validating fields in our custom view
     *
     * @return {bool}  If validation is successful or not
     */
    validateFields: function () {
        app.alert.dismissAll()
        var isValidated = true;
        _.each(this.fields, function (field) {
            var fieldValue = this.model.get(field.name);
            //all values are required
            console.log('field: ', field.name, 'field value: ', fieldValue);
            if (field.def.required && !fieldValue) {
                console.log('in if 1');
                isValidated = false;
            } else if (field.def.type == 'int' && !(/^\d+$/.test(fieldValue))) {
                // If field value is not a number
                console.log('in else');
               isValidated = false;
            }
            console.log('field def: ', field.def);
            if (!isValidated) {
                app.alert.show('invalid_data_error', {
                    level: 'error',
                    autoClose: false,
                    messages: app.lang.get(field.def.error_message),
                });
            }
        }, this);

        return isValidated;
    },
    /**
     * @inheritdoc
     */
    _render: function () {
        url = app.api.buildURL('get_appointment_config', null, null, null);
        var self = this;
        app.api.call('read', url, null, {
            success: function (serverData) {
                if (_.isEmpty(serverData) || serverData.length == 0) {
                    return;
                }
                _.each(self.meta.panels, function (panel) {
                    _.each(panel, function (fieldsArray) {
                        _.each(fieldsArray, function (fields) {
                            _.each(fields, function (field) {
                                fieldName = field.name;
                                if (!_.isUndefined(serverData.data[fieldName])) {
                                    self.model.set(fieldName, serverData.data[fieldName]);
                                }
                                
                            });
                        });
                    });
                });
            },
            error: function (error) {
                app.alert.show('appointment_config__error', {
                    level: 'error',
                    autoClose: true,
                    messages: 'LBL_ERR_GET_APPOINTMENT_CONFIG',
                });
            },
            complete: function () {
                app.alert.dismiss('sending_wait');
/*                if (!app.acl.hasAccess('admin', 'aud_Job_Queue')) {
                    app.error.handleRenderError(self, 'view_render_denied');
                    app.controller.loadView({
                        layout: 'error',
                        errorType: '404',
                        module: 'Error',
                        create: true
                    });
                    return;
                }*/
                self._super('_render');
            },
        }); 
    }
})

