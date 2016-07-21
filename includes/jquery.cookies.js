
(function($) {
    $.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);
/*!
 * jQuery Cookie Plugin
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 * https://github.com/carhartl/jquery-cookie
 Create session cookie:
$.cookie('the_cookie', 'the_value');

Create expiring cookie, 7 days from then:
$.cookie('the_cookie', 'the_value', { expires: 7 });

Create expiring cookie, valid across entire page:
$.cookie('the_cookie', 'the_value', { expires: 7, path: '/' });

Read cookie:
$.cookie('the_cookie'); // => 'the_value'
$.cookie('not_existing'); // => null

Delete cookie by passing null as value:
$.cookie('the_cookie', null);

Note: when deleting a cookie, you must pass the exact same path, domain and secure options that were used to set the cookie.
Options
expires: 365

Define lifetime of the cookie. Value can be a Number (which will be interpreted as days from time of creation) or a Date object. If omitted, the cookie is a session cookie.
path: '/'

Default: path of page where the cookie was created.

Define the path where cookie is valid. By default the path of the cookie is the path of the page where the cookie was created (standard browser behavior). If you want to make it available for instance across the entire page use path: '/'.
domain: 'example.com'

Default: domain of page where the cookie was created.
secure: true

Default: false. If true, the cookie transmission requires a secure protocol (https).
raw: true

Default: false.

By default the cookie is encoded/decoded when creating/reading, using encodeURIComponent/decodeURIComponent. Turn off by setting raw: true.
 */
