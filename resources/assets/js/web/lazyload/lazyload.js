'use strict';

(function () {
    function logElementEvent(eventName, element) {
        Date.now(), eventName, element.getAttribute("data-src");
    }

    var callback_enter = function (element) {
        logElementEvent("ENTERED", element);
    };
    var callback_exit = function (element) {
        logElementEvent("EXITED", element);
    };
    var callback_loading = function (element) {
        logElementEvent("LOADING", element);
    };
    var callback_loaded = function (element) {
        logElementEvent("LOADED", element);
    };
    var callback_error = function (element) {
        logElementEvent("ERROR", element);
        element.src = "https://via.placeholder.com/440x560/?text=Error+Placeholder";
    };
    var callback_finish = function () {
        logElementEvent("FINISHED", document.documentElement);
    };
    var callback_cancel = function (element) {
        logElementEvent("CANCEL", element);
    };

    var ll = new LazyLoad({
        class_applied: "lz-applied",
        class_loading: "lz-loading",
        class_loaded: "lz-loaded",
        class_error: "lz-error",
        class_entered: "lz-entered",
        class_exited: "lz-exited",
        callback_enter: callback_enter,
        callback_exit: callback_exit,
        callback_cancel: callback_cancel,
        callback_loading: callback_loading,
        callback_loaded: callback_loaded,
        callback_error: callback_error,
        callback_finish: callback_finish
    });
})();
