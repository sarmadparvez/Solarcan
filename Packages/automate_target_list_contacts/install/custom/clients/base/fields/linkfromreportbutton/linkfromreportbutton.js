({
    extendsFrom: 'LinkfromreportbuttonField',
    selectDrawerCallback: function(model) {
        if (!model || _.isEmpty(model.id)) {
            return;
        }

        if (model.module != this.context.get('module')) {
            app.alert.show('listfromreport-warning', {
                level: 'warning',
                messages: app.lang.get('LBL_LINK_FROM_REPORT_WRONG_MODULE'),
                autoClose: true
            });
            return;
        }

        var recordListUrl = app.api.buildURL('Reports', 'record_list', {id: model.id}),
            self = this;
            self.report_id = model.id;
        app.alert.show('listfromreport_loading', {level: 'process', title: app.lang.get('LBL_LOADING')});

        app.api.call(
            'create',
            recordListUrl,
            null,
            {
                success: _.bind(self.linkRecordList, self),
                error: function(error) {
                    app.alert.dismiss('listfromreport_loading');
                    app.alert.show('server-error', {
                        level: 'error',
                        title: app.lang.get('ERR_INTERNAL_ERR_MSG'),
                        messages: ['ERR_HTTP_500_TEXT_LINE1', 'ERR_HTTP_500_TEXT_LINE2']
                    });
                }
            }
        );
    },

    /**
     * Links records from a report to the parent record
     * @param {Object} response
     */
    linkRecordList: function(response) {
        var parentModel = this.context.get('parentModel'),
            parentModule = parentModel.get('module') || parentModel.get('_module'),
            link = this.context.get('link'), action = 'link/' + link + '/add_record_list',
            url = app.api.buildURL(
                parentModule,
                action,
                {
                    id: parentModel.get('id'),
                    relatedId: response.id,
                }
            );
        if (parentModule == 'ProspectLists' && this.report_id 
            && this.module == 'Contacts') {
            url = url+'?report_id='+this.report_id;
        }
        app.api.call('create', url, null, {
            success: _.bind(this.linkSuccessCallback, this),
            error: _.bind(this.linkErrorCallback, this),
            complete: function(data) {
                app.alert.dismiss('listfromreport_loading');
            }
        });
    },
})
