(function() {
  window.addEventListener('CookieInformationConsentGiven', function (event) {
    if (CookieInformation.getConsentGivenFor('cookie_cat_statistic')) {
      var sz = document.createElement('script');
      sz.type = 'text/javascript';
      sz.async = true;
      sz.src = '//ssl.siteimprove.com/js/siteanalyze_2240844.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(sz, s);
    }
  }, false);
})();
