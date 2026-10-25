(function () {
  'use strict';

  var navigating = false;
  var pageCache = new Map();
  var prefetchTimers = new Map();
  var cacheLifetime = 60000;

  function isInternalPageLink(link, event) {
    if (!link || !link.href || event.defaultPrevented) return false;
    if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return false;
    if (link.target && link.target !== '_self') return false;
    if (link.hasAttribute('download')) return false;

    var url = new URL(link.href, window.location.href);
    if (url.origin !== window.location.origin) return false;
    if (url.pathname.indexOf('/admin') === 0 || url.pathname.indexOf('/api') === 0) return false;
    if (url.pathname === window.location.pathname && url.hash) return false;
    return url.pathname !== window.location.pathname || url.search !== window.location.search;
  }

  function isPrefetchableUrl(url) {
    return url.origin === window.location.origin &&
      url.pathname.indexOf('/admin') !== 0 &&
      url.pathname.indexOf('/api') !== 0 &&
      (url.pathname !== window.location.pathname || url.search !== window.location.search);
  }

  function requestPage(url) {
    var key = url.href;
    var cached = pageCache.get(key);
    if (cached && Date.now() - cached.createdAt < cacheLifetime) return cached.promise;

    var request = fetch(key, {
      headers: { 'X-Requested-With': 'fetch' },
      credentials: 'same-origin'
    }).then(function (response) {
      if (!response.ok) throw new Error('页面请求失败：' + response.status);
      return response.text();
    }).catch(function (error) {
      pageCache.delete(key);
      throw error;
    });

    pageCache.set(key, { createdAt: Date.now(), promise: request });
    return request;
  }

  function prefetch(link) {
    if (!link || !link.href) return;
    var url = new URL(link.href, window.location.href);
    if (!isPrefetchableUrl(url)) return;
    requestPage(url).catch(function () {});
  }

  function updateActiveNavigation(url) {
    document.querySelectorAll('#main-nav a').forEach(function (navLink) {
      var active = false;
      try {
        var navUrl = new URL(navLink.href, window.location.href);
        active = navUrl.origin === url.origin && navUrl.pathname === url.pathname;
      } catch (error) {
        active = false;
      }
      navLink.classList.toggle('active', active);
      if (active) navLink.setAttribute('aria-current', 'page');
      else navLink.removeAttribute('aria-current');
    });
  }

  function updatePageStyles(nextDocument) {
    var currentStyle = document.head.querySelector('[data-page-style]');
    var nextStyle = nextDocument.head.querySelector('[data-page-style]');
    if (currentStyle) currentStyle.remove();
    if (nextStyle) document.head.appendChild(nextStyle.cloneNode(true));
  }

  function runPageScripts(documentFragment) {
    documentFragment.querySelectorAll('script:not([src])').forEach(function (script) {
      var code = script.textContent.trim();
      if (code) (new Function(code))();
    });
    document.dispatchEvent(new CustomEvent('page:loaded'));
  }

  function replacePage(url, html) {
    var nextDocument = new DOMParser().parseFromString(html, 'text/html');
    var currentMain = document.querySelector('main');
    var nextMain = nextDocument.querySelector('main');
    if (!currentMain || !nextMain) throw new Error('页面缺少 main 内容区域');

    currentMain.replaceWith(nextMain);
    updatePageStyles(nextDocument);
    document.title = nextDocument.title;
    updateActiveNavigation(url);
    window.scrollTo(0, 0);
    runPageScripts(nextDocument.body);
  }

  async function navigate(url, addHistory) {
    if (navigating) return;
    navigating = true;
    document.documentElement.classList.add('is-page-loading');

    try {
      var html = await requestPage(url);
      var swap = function () { replacePage(url, html); };

      if (document.startViewTransition) await document.startViewTransition(swap).finished;
      else swap();
      if (addHistory) window.history.pushState({ page: url.href }, '', url.href);
    } catch (error) {
      window.location.assign(url.href);
    } finally {
      document.documentElement.classList.remove('is-page-loading');
      navigating = false;
    }
  }

  document.addEventListener('click', function (event) {
    var link = event.target.closest && event.target.closest('a');
    if (!isInternalPageLink(link, event)) return;
    event.preventDefault();
    navigate(new URL(link.href, window.location.href), true);
  });

  document.addEventListener('pointerover', function (event) {
    var link = event.target.closest && event.target.closest('a');
    if (!link || (event.relatedTarget && link.contains(event.relatedTarget))) return;
    if (!link.closest('#main-nav')) return;
    var key = link.href;
    if (prefetchTimers.has(key)) return;
    var timer = window.setTimeout(function () {
      prefetchTimers.delete(key);
      prefetch(link);
    }, 65);
    prefetchTimers.set(key, timer);
  });

  document.addEventListener('pointerdown', function (event) {
    var link = event.target.closest && event.target.closest('#main-nav a');
    if (link) prefetch(link);
  });

  document.addEventListener('touchstart', function (event) {
    var link = event.target.closest && event.target.closest('#main-nav a');
    if (link) prefetch(link);
  }, { passive: true });

  window.addEventListener('popstate', function () {
    navigate(new URL(window.location.href), false);
  });
})();
