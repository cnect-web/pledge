/* 
 * M.M.Verona - Open Evidence - 2017
 * 
 */

$(document).ready(function() { 
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
    $('.accept-cookie').click(function () {
      setCookie("acookie", "accepted", 365);
      cookieContent.hide(500);
    });
    
    $('#evidence-text a').attr('target', '_blank');
});



function set_feedback(txt,type,ms){

    if(ms==null){ms=4000;}
    $('#feedback').html(txt);
    $('#feedback').css("left", ( $(window).width() - $('#feedback').width() ) / 2 + $(window).scrollLeft() + "px");

    if(type==='alert'){
        $('#feedback').addClass('feed_ko').removeClass('feed_ok').removeClass('feed_danger');
    }
    else if(type==='danger'){
        $('#feedback').addClass('feed_danger').removeClass('feed_ok').removeClass('feed_ko');
    }
    else{
        $('#feedback').addClass('feed_ok').removeClass('feed_ko').removeClass('feed_danger');
    }

    $('#feedback').show();

    setTimeout(function() {
        $('#feedback').fadeOut('fast');
    }, ms);
}

