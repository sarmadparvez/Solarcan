// Tell jQuery to watch for any 401 or 403 errors and handle them appropriately
$.ajaxSetup({
    statusCode: {
        401: function(){
            // Redirect the to the login page.
            delete window.sessionStorage.logged_in;
            window.location.replace('#login');
            //app.navigate("login", true);
        }
    }
});

var AppRouter = Backbone.Router.extend({

    routes: {
        ""                  : "portalcontainerView",
        "login" : "login",
        "contact/:id" : "portalcontainerView",
        "notification" : "notificationView"
    },

    initialize: function () {
        this.headerView = new HeaderView();
        this.FooterView = new FooterView();
        $('.header').html(this.headerView.el);
        $('#footer').html(this.FooterView.el);
    },

    login: function(page) {
        if (!window.sessionStorage.logged_in) {
            utils.checkLogin();
            // if already logged in, checked from server
            if (window.sessionStorage.logged_in) {
                window.location.replace("");
                return;
            }
        } else {
            // if already logged in, checked from browser sessionStorage
            window.location.replace("");
            return;
        }
        $("#content").html(new LoginView({model: new User()}).el);
    },

    signup: function(page) {
        $("#content").html(new SignupView({model: new User()}).el);
    },

    portalcontainerView:function (id) {
        // check if user is logged in
        if (!window.sessionStorage.logged_in) {
            utils.checkLogin();
            if (!window.sessionStorage.logged_in) {
                return;
            }
        }
        if (!_.isUndefined(id) && !_.isEmpty(id)) {
            var pcv = new PortalContainerView({contact_id: id});
            $("#content").html(pcv.el);
        } else {
            $("#content").html(new PortalContainerView().el);
        }
    },

    notificationView: function()
    {
        $("#content").html(new NotificationView().el);
    }

});

utils.loadTemplate([
    'HeaderView',
    'FooterView',
    'LoginView',
    'PortalContainerView',
    'ContactInfoView',
    'AccountView',
    'NotificationView'
], function() {
    app = new AppRouter();
    Backbone.history.start({root: ""});
});