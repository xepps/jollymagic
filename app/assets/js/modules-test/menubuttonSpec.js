define(
    [
        'jollymagic/util',
        'jollymagic/menuButton'
    ],
    function (Util, MenuButton) {
        'use strict';

        describe('The menu button', function() {

            var nav,
                button,
                menuButton;

            beforeEach(function() {
                nav = createNodeWithClass('nav', 'nav');
                Util.addClass(nav, 'nav_open');
                button = createNodeWithClass('menu_button', 'button');
                Util.addClass(button, 'menu_open');
                menuButton = new MenuButton(nav, button);
            });

            it('displays the menu on click', function() {
                setWindowWidthToMobile();

                menuButton.init();
                Util.fireEvent('click', {}, button);

                expect(Util.hasClass(nav, 'nav_open')).toBeTruthy();
                expect(Util.hasClass(nav, 'nav_closed')).toBeFalsy();

                Util.fireEvent('click', {}, button);

                expect(Util.hasClass(nav, 'nav_open')).toBeFalsy();
                expect(Util.hasClass(nav, 'nav_closed')).toBeTruthy();
            });

            it('toggles the button\'s class on click', function() {
                setWindowWidthToMobile();

                menuButton.init();
                Util.fireEvent('click', {}, button);

                expect(Util.hasClass(button, 'menu_open')).toBeFalsy();
                expect(Util.hasClass(button, 'menu_close')).toBeTruthy();

                Util.fireEvent('click', {}, button);

                expect(Util.hasClass(button, 'menu_close')).toBeFalsy();
                expect(Util.hasClass(button, 'menu_open')).toBeTruthy();
            });

        });


        function createNodeWithClass(className, type) {
            if (type === undefined) {
                type = 'div';
            }
            var element = document.createElement(type);
            element.classList.add(className);
            return element;
        }

        function setWindowWidthToMobile() {
            window.innerWidth = Util.mobileMaxSize;
        }
    }
);
