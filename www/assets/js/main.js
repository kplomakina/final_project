"use strict";

$(document).ready(function ($) {
    cookieNotification();
    hideCookieNotification();
    var url = document.location.href;
    $.each($(".main-menu a"), function () {
        if (this.href == url) {
            $(this).addClass('main-menu__active-link');
        };
    });
});

$(".accordions").on("click", ".accordions_title", function () {
    $(this).toggleClass("active").next(".accordions_content").slideToggle();
});

$(document).on("click", "#add-to-cart", function (e) {
    e.preventDefault();
    $(this).attr("hidden", true);
    $(this).next().attr("hidden", false);
});

$(document).on("click", "#remove-from-cart", function (e) {
    e.preventDefault();
    $(this).closest("tr").attr("hidden", true);
});

$(document).on("click", "#user-logout", function (e) {
    deleteCookie('user');
    deleteCookie('token');
    deleteCookie('tokenTime');
    deleteCookie('cart');
});

var hideCookieNotification = function () {
    $('.js-cookie-notification').delay(5000).fadeOut("slow");
    setCookie('CookieNotificationCookie', 'true', {
        expires: 365
    });
};

var cookieNotification = function () {
    var setCookieNotification = function () {
        $('.js-cookie-notification').fadeOut("slow");
        setCookie('CookieNotificationCookie', 'true', {
            expires: 365
        });
        return false;
    };
    if (getCookie('CookieNotificationCookie') === 'true') {
        console.log('cookie notification set');
    } else {
        console.log('cookie notification not set');
        $('.js-cookie-notification').css({
            'display': 'block'
        });
        $('.js-cookie-notification').setCookieNotification;
    };
}



CKEDITOR.replace('editor1');
