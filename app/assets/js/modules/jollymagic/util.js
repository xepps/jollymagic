define(
    'jollymagic/util',
    [],

    function() {
        'use strict';

        return {

            mobileMaxSize: 799,
            desktopMinSize: 800,

            windowWidth: function() {
                return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            },

            hasClass: function(elem, cls) {
                var re = new RegExp("(?:^| )(" + cls + ")(?: |$)");
                return re.test(elem.className);
            },

            addClass: function(elem, cls) {
                if (elem.classList) {
                    return elem.classList.add(cls);
                }

                if (!this.hasClass(elem, cls)) {
                    var className = elem.className;
                    className += " " + cls;
                    elem.className = className.trim();
                }
            },

            removeClass: function(elem, cls) {
                if (elem) {
                    if (elem.classList) {
                        return elem.classList.remove(cls);
                    }
                    elem.className = elem.className.replace(cls, '');
                }
            },

            addEvent: function(type, listener, element) {
                if (!element) {
                    element = window;
                }

                if (element.addEventListener) {
                    element.addEventListener(type, listener, false);
                } else if (element.attachEvent) {
                    element.attachEvent('on' + type, listener);
                }
            },

            removeEvent: function(type, listener, element) {
                if (!element) {
                    element = window;
                }

                if (element.removeEventListener) {
                    element.removeEventListener(type, listener, false);
                } else if (element.detachEvent) {
                    element.detachEvent('on' + type, listener);
                }
            },

            fireEvent: function(type, data, element) {
                if(!element) {
                    element = window;
                }
                if (document.createEvent) {
                    var obj = document.createEvent('Event');
                    obj.initEvent(type, false, false);

                    if (typeof data == "object") {
                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                obj[key] = data[key];
                            }
                        }
                    }

                    element.dispatchEvent(obj);
                }
            },
        };
    }
);
