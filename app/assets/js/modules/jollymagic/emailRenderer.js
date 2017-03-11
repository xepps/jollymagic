define(
    "jollymagic/emailRenderer",
    [
        'jollymagic/util'
    ],

    function (Util) {
        'use strict';

        var EmailRenderer = function(emailTags) {
            this.emailTags = emailTags;
        };

        EmailRenderer.prototype.render = function() {
            var i, 
                length = this.emailTags.length;

            for(i = 0; i < length; i += 1) {
                var address = this.emailTags[i].innerText.replace(/\(AT\)/g, '@');
                this.emailTags[i].href = 'mailto:' + address;
                this.emailTags[i].innerText = address;
            }
        };

        return EmailRenderer;
    }
);
