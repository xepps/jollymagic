define(
    "jollymagic/controller",
    [
        "jollymagic/menuButton"
    ],

    function(MenuButton) {
        "use strict";

        var Controller = function(page) {
            this.page = page;
        };

        Controller.prototype.init = function() {
            this.initMenuButton();
        };

        Controller.prototype.initMenuButton = function() {
            var nav = this.page.querySelector('.nav'),
                button = this.page.querySelector('.menu_button');
            this.menuButton = new MenuButton(nav, button);
            this.menuButton.init();
        };

        return Controller;
    }
);
