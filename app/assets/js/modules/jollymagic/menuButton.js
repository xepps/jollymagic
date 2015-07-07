define(
    "jollymagic/menuButton",
    [
        'jollymagic/util'
    ],

    function (Util) {
        'use strict';

        var MenuButton = function(nav, button) {
            this.nav = nav;
            this.button = button;
            this.closed = true;

            var self = this;
            this.menuButtonClickListener = function(event) {
                event.preventDefault();
                self.toggleMenu();
            };
        };

        MenuButton.prototype.init = function() {
            Util.addEvent('click', this.menuButtonClickListener, this.button);
        };

        MenuButton.prototype.toggleMenu = function() {
            if (this.closed) {
                this.openNav();
            } else {
                this.closeNav();
            }
            this.closed = !this.closed;
        };

        MenuButton.prototype.openNav = function() {
            Util.removeClass(this.button, 'menu_open');
            Util.addClass(this.button, 'menu_close');

            Util.removeClass(this.nav, 'nav_closed');
            Util.addClass(this.nav, 'nav_open');
        };

        MenuButton.prototype.closeNav = function() {
            Util.removeClass(this.button, 'menu_close');
            Util.addClass(this.button, 'menu_open');

            Util.removeClass(this.nav, 'nav_open');
            Util.addClass(this.nav, 'nav_closed');
        };

        return MenuButton;
    }
);
