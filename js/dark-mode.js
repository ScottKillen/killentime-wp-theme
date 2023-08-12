document.addEventListener('DOMContentLoaded', function () {
  //Create the cookie object
  var cookieStorage = {
    setCookie: function setCookie(key, value, time, path) {
      var expires = new Date();
      expires.setTime(expires.getTime() + time);
      var pathValue = '';

      if (typeof path !== 'undefined') {
        pathValue = 'path=' + path + ';';
      }

      document.cookie =
        key +
        '=' +
        value +
        ';' +
        pathValue +
        'expires=' +
        expires.toUTCString();
    },
    getCookie: function getCookie(key) {
      var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
      return keyValue ? keyValue[2] : null;
    },

    removeCookie: function removeCookie(key) {
      document.cookie = key + '=; Max-Age=0; path=/';
    },
  };

  var body = document.body;
  var switcher = document.getElementsByClassName('darkmode-button')[0];
  if (!switcher) return;
  //Click on dark mode icon. Add dark mode classes and wrappers. Store user preference through sessions
  switcher.addEventListener('click', function () {
    this.classList.toggle('active');
    //If dark mode is selected
    if (this.classList.contains('active')) {
      body.classList.add('dark');
      //Save user preference as a cookie
      cookieStorage.setCookie('darkMode', 'true', 2628000000, '/');
    } else {
      body.classList.remove('dark');
      setTimeout(function () {
        cookieStorage.removeCookie('darkMode');
      }, 100);
    }
  });

  //Check Storage. Keep user preference on page reload
  if (cookieStorage.getCookie('darkMode')) {
    body.classList.add('dark');
    switcher.classList.add('active');
  }
});
