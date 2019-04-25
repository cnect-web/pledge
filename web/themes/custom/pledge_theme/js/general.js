(function ($, Drupal) {
    Drupal.behaviors.pledgeGeneral = {
        attach: function (context, settings) {
            $('h3.trigger-filters', context).on('click', function(){
                $('#views-exposed-form-pledges-page').toggleClass('sr-only');
            });

            var cookie = false;
            var cookieContent = $('.cookie-disclaimer');

            checkCookie();

            if (cookie !== true) {
              cookieContent.show();
            }

            function setCookie(cname, cvalue, exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
              var expires = "expires=" + d.toGMTString();
              document.cookie = cname + "=" + cvalue + "; " + expires;
            }

            function getCookie(cname) {
              var name = cname + "=";
              var ca = document.cookie.split(';');
              for (var i = 0; i < ca.length; i++) {
                var c = ca[i].trim();
                if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
              }
              return "";
            }

            function checkCookie() {
              var check = getCookie("acookie");
              if (check !== "") {
                return cookie = true;
              } else {
                return cookie = false; //setCookie("acookie", "accepted", 365);
              }

            }
            $('.accept-cookie', context).click(function () {
              setCookie("acookie", "accepted", 365);
              cookieContent.hide(500);
            });

            $('#evidence-text a', context).attr('target', '_blank');

            function set_feedback(txt,type,ms){

                if (ms == null) {
                    ms = 4000;
                }

                var feedbackItem = $('#feedback');
                feedbackItem.html(txt);
                feedbackItem.css("left", ( $(window).width() - feedbackItem.width() ) / 2 + $(window).scrollLeft() + "px");

                if (type === 'alert'){
                    feedbackItem.addClass('feed_ko').removeClass('feed_ok').removeClass('feed_danger');
                }
                else if (type === 'danger') {
                    feedbackItem.addClass('feed_danger').removeClass('feed_ok').removeClass('feed_ko');
                }
                else{
                    feedbackItem.addClass('feed_ok').removeClass('feed_ko').removeClass('feed_danger');
                }

                feedbackItem.show();

                setTimeout(function() {
                    feedbackItem.fadeOut('fast');
                }, ms);
            }
        }
    };
})(jQuery, Drupal);