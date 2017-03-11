define(
    [
        'jollymagic/util',
        'jollymagic/emailRenderer'
    ],
    function (Util, EmailRenderer) {
        'use strict';

        describe('An email address', function() {

            var emailRenderer,
                emailTag;

            beforeEach(function() {
                emailTag = createNodeWithClass('a', 'a');
                emailTag.innerText = 'kristian(AT)xepps.com'
                Util.addClass(emailTag, 'email-address');

                emailRenderer = new EmailRenderer([emailTag]);
            });

            it('renders the email address as a link', function() {
                emailRenderer.render();

                expect(emailTag.innerText).toEqual('kristian@xepps.com');
                expect(emailTag.href).toEqual('mailto:kristian@xepps.com');
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
    }
);
