define(
    "jollymagic/controller",
    [
        "jollymagic/menuButton",
        "jollymagic/emailRenderer"
    ],

    function(MenuButton, EmailRenderer) {
        "use strict";

        var Controller = function(page) {
            this.page = page;
        };

        Controller.prototype.init = function() {
            this.initMenuButton();
            this.renderEmailAddresses();
        };

        Controller.prototype.initMenuButton = function() {
            var nav = this.page.querySelector('nav'),
                button = this.page.querySelector('.menu_button');
            this.menuButton = new MenuButton(nav, button);
            this.menuButton.init();
        };

        Controller.prototype.renderEmailAddresses = function() {
            this.emailRenderer = new EmailRenderer(
                this.page.querySelectorAll('.email-address')
            );
            this.emailRenderer.render();
        };

        return Controller;
    }
);
