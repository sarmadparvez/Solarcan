window.FooterView = Backbone.View.extend({

    initialize: function () {
        this.render();
    },

    render: function () {
        $(this.el).html(this.template());
        return this;
    },
   /* events:{
        "click .new":"newWine"
    },

    newWine:function (event) {
        app.navigate("wines/new", true);
        return false;
    }*/

});