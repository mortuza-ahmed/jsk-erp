!(function (i) {
    "use strict";
    function a() {}
    (a.prototype.init = function () {
        i(".select2").select2(),
            i(".select2-limiting").select2({ maximumSelectionLength: 2 });
        var e = {};
        i('[data-toggle="touchspin"]').each(function (a, n) {
            var t = i.extend({}, e, i(n).data());
            i(n).TouchSpin(t);
        }),
            i("textarea.length_count").maxlength({
                alwaysShow: !0,
                warningClass: "badge bg-info",
                limitReachedClass: "badge bg-warning",
            }),
            i("input.length_count").maxlength({
                threshold: 20,
                warningClass: "badge bg-info",
                limitReachedClass: "badge bg-warning",
            });
    }),
        (i.AdvancedForm = new a()),
        (i.AdvancedForm.Constructor = a);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.AdvancedForm.init();
    })();
