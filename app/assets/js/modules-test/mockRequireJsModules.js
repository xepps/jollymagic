define(
    '_mock_jollymagic/menuButton',
    function() {
        'use strict';

        var MenuButton = jasmine.createSpy();

        MenuButton.prototype.init = jasmine.createSpy();

        MenuButton.resetMock = function() {
            MenuButton.reset();
            MenuButton.prototype.init.reset();
        };

        return MenuButton;
    }
);
