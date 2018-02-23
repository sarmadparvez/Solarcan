// Tell jQuery to watch for any 401 or 403 errors and handle them appropriately
$.ajaxSetup({
    statusCode: {
        401: function(){
            // Redirect the to the login page.
            console.log('in 401');
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
        //"portalcontainer" : "portalcontainerView",
        "user/add" : "signup"
/*        ""                  : "list",
        "wines/page/:page"	: "list",
        "wines/add"         : "addWine",
        "wines/:id"         : "wineDetails",
        "about"             : "about"*/
    },

    initialize: function () {
        this.headerView = new HeaderView();
        this.FooterView = new FooterView();
        $('.header').html(this.headerView.el);
        $('#footer').html(this.FooterView.el);
    },

    login: function(page) {
        $("#content").html(new LoginView({model: new User()}).el);
    },

    signup: function(page) {
        $("#content").html(new SignupView({model: new User()}).el);
    },

    portalcontainerView:function () {
        $("#content").html(new PortalContainerView().el);
    },

/*
	list: function(page) {
        var p = page ? parseInt(page, 10) : 1;
        var wineList = new WineCollection();
        wineList.fetch({success: function(){
            $("#content").html(new WineListView({model: wineList, page: p}).el);
        }});
        this.headerView.selectMenuItem('home-menu');
    },

    wineDetails: function (id) {
        var wine = new Wine({id: id});
        wine.fetch({success: function(){
            $("#content").html(new WineView({model: wine}).el);
        }});
        this.headerView.selectMenuItem();
    },

	addWine: function() {
        var wine = new Wine();
        $('#content').html(new WineView({model: wine}).el);
        this.headerView.selectMenuItem('add-menu');
	},

    about: function () {
        if (!this.aboutView) {
            this.aboutView = new AboutView();
        }
        $('#content').html(this.aboutView.el);
        this.headerView.selectMenuItem('about-menu');
    }*/

});

utils.loadTemplate([
    'HeaderView',
    'FooterView',
    'LoginView',
    'PortalContainerView',
    'SignupView',
    'ContactInfoView',
    'AccountView'
], function() {
    app = new AppRouter();
    Backbone.history.start();
});