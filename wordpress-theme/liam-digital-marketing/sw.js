/* Narrowly-scoped service worker: caches only the self-hosted Spline
   runtime/scene files (assets/vendor/spline/*) so refreshes and return
   visits load them from local cache instead of depending on network
   conditions each time. Everything else on the site is left entirely
   to the browser's normal HTTP cache -- this file has no opinion about
   any other asset.

   Bump CACHE_NAME whenever the vendored spline files themselves change
   (e.g. the runtime or scene is updated) so old cached copies get
   discarded on activate rather than silently going stale. */
var CACHE_NAME = "ldm-spline-cache-v1";
var CACHE_MATCH = /\/assets\/vendor\/spline\//;

self.addEventListener("install", function (event) {
  self.skipWaiting();
});

self.addEventListener("activate", function (event) {
  event.waitUntil(
    caches
      .keys()
      .then(function (names) {
        return Promise.all(
          names
            .filter(function (name) { return name !== CACHE_NAME; })
            .map(function (name) { return caches.delete(name); })
        );
      })
      .then(function () { return self.clients.claim(); })
  );
});

self.addEventListener("fetch", function (event) {
  if (event.request.method !== "GET" || !CACHE_MATCH.test(event.request.url)) return;

  event.respondWith(
    caches.open(CACHE_NAME).then(function (cache) {
      return cache.match(event.request).then(function (cached) {
        if (cached) return cached;
        return fetch(event.request).then(function (response) {
          if (response && response.ok) cache.put(event.request, response.clone());
          return response;
        });
      });
    })
  );
});
