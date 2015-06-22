require.config({
    "map": {
        "jollymagic/controller": {
            "jollymagic/menuButton": "_mock_jollymagic/menuButton"
        }
    }
});

define(
    [
        'jollymagic/controller',
        '_mock_jollymagic/menuButton'
    ],
    function(Controller, MenuButton) {
        'use strict';

        var page,
            controller;

        describe('The Jollymagic js controller', function() {

            beforeEach(function() {
                page = document.createElement('div');
                document.body.appendChild(page);
                controller = new Controller(page);
            });

            afterEach(function() {
                MenuButton.resetMock();
            });

            it('initialises the menuButton on init', function() {
                controller.init();

                expect(MenuButton.prototype.init).toHaveBeenCalled();
            });
        });
    }
);
