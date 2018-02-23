window.HeaderView = Backbone.View.extend({

    initialize: function () {
        this.render();
    },

    render: function () {
        $(this.el).html(this.template());
        return this;
    },

    events:{
        "click #logout": "logout"
    },

    logout: function()
    {
        console.log('logout clicked');
        $.ajax({
            method: "POST",
            url: "api/logout",
            dataType: 'json',
            success: _.bind(function(response) {
                console.log('in success of logout ', response);
                if (response.result) {
                    delete window.sessionStorage.logged_in;
                    app.navigate("login", true);
                }
            }, this),
            error: _.bind(function(error) {
                alert(error.statusText);
            }, this)
        });
    }

});