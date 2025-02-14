!function (n) {

    "use strict"; function t() {

    }
    t.prototype.updateOutput = function (t) {
        var e = t.length ? t : n(t.target), a = e.data("output");
        window.JSON ? a.val(
            window.JSON.stringify(e.nestable("serialize"))) : a.val("JSON browser support required for this demo.")
    },
        t.prototype.init = function () {
            n(".nestable_list_3")
                .nestable()
        }, n.Nestable = new t, n.Nestable.Constructor = t
}(
    window.jQuery), function () {

        "use strict";
        window.jQuery.Nestable.init()
    }();