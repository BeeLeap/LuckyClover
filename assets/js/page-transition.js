(function () {
  'use strict';

  if (typeof window.Swup !== 'function' ||
      typeof window.SwupHeadPlugin !== 'function' ||
      typeof window.SwupPreloadPlugin !== 'function' ||
      typeof window.SwupScriptsPlugin !== 'function') return;

  function updateActiveNavigation() {
    var currentUrl = new URL(window.location.href);
    document.querySelectorAll('#main-nav a').forEach(function (navLink) {
      var active = false;
      try {
        var navUrl = new URL(navLink.href, window.location.href);
        active = navUrl.origin === currentUrl.origin && navUrl.pathname === currentUrl.pathname;
      } catch (error) {
        active = false;
      }
      navLink.classList.toggle('active', active);
      if (active) navLink.setAttribute('aria-current', 'page');
      else navLink.removeAttribute('aria-current');
    });
  }

  var swup = new window.Swup({
    containers: ['main'],
    animationSelector: 'main',
    plugins: [
      new window.SwupHeadPlugin({ awaitAssets: true }),
      new window.SwupPreloadPlugin({ preloadHoveredLinks: true }),
      new window.SwupScriptsPlugin({ head: false, body: true, optin: true })
    ]
  });

  swup.hooks.on('page:view', function () {
    updateActiveNavigation();
    document.dispatchEvent(new CustomEvent('page:loaded'));
  });

  updateActiveNavigation();
})();
