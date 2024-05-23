import 'jsgrid';
var id = $('#parc-id').data('id');
console.log(id);
var JsDBSource = {
    loadData: function (n) {
        return $.ajax({ type: "GET", url: "/filiere/ajax/" + id, data: n })
    },
    insertItem: function (e) {
        return $.ajax({ type: "POST", url: "/filiere/ajax/" + id, data: e })
    },
    updateItem: function (e) {
        return $.ajax({ type: "PUT", url: "/filiere/ajax/" + id, data: e })
    },
    deleteItem: function (e) {
        return $.ajax({ type: "DELETE", url: "/filiere/ajax/" + id, data: e })
    }
}; !function (n) {
    "use strict";
    function e() { this.$body = n("body") }
    e.prototype.createGrid = function (e, t) {
        e.jsGrid(n.extend({
            height: "600",
            width: "100%",
            heading: true,
            selecting: true,
            filtering: false,
            editing: false,
            inserting: false,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
        }, t))
    },
        e.prototype.init = function () {
            var e = {
                fields: [
                    { name: "Réf Filière", type: "text" },
                    { name: "Remplissage Filière (%)", type: "text" },
                    { name: "Capacité Filière (u)", type: "number" },
                    { name: "Places Remplies (u)", type: "number" },
                    { name: "Places Vides (u)", type: "number" },
                    { name: "Taille Filière (m)", type: "number" },
                    { name: "Nombre de place totale", type: "number" },
                    { name: "Nombre de place vide", type: "number" },
                    { name: "Nombre de place remplis", type: "number" },
                    { name: "Nombre de place corde", type: "number" },
                    { name: "Nombre de place corde huitre", type: "number" },
                    { name: "Nombre de place corde moule", type: "number" },
                    { name: "Nombre de place corde lanterne", type: "number" },
                    { name: "Date Min MAE", type: "text" },
                    { name: "Segments", type: "text" }
                ],
                controller: JsDBSource
            };
            this.createGrid(n("#jsGrid"), e)
        },
        n.GridApp = new e, n.GridApp.Constructor = e
}(window.jQuery), function () {
    "use strict"; window.jQuery.GridApp.init()
}();
