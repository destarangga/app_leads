const CACHE_NAME = 'aiskindo-cache-v1';
const urlsToCache = [
  '/',
  '/frontend/assets/css/style.bundle.css',
  '/frontend/assets/js/script.bundle.js',
  '/frontend/assetslog/style.css',
  '/frontend/assets/media/logos/aiskindo-logo.png',
  '/frontend/assets/media/logos/aiskindo-logo.png',
];

// Install service worker
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
      caches.match(event.request).then((response) => {
        if (response) {
          return response; // Jika ada di cache, gunakan cache
        }
        return fetch(event.request).then((networkResponse) => {
          return caches.open(CACHE_NAME).then((cache) => {
            // Cache file yang baru diambil dari jaringan
            cache.put(event.request, networkResponse.clone());
            return networkResponse;
          });
        });
      })
    );
  });
  
  
