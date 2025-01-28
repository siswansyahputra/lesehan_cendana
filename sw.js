const CACHE_NAME = 'pwa-cache-v1';
const ASSETS = [
  '/',
  'index.php',
  'media.php',
  'style.css',
  'script.js',
  'icons/icon-192x192.png',
  'icons/icon-512x512.png',
  'icons/meja.jpg',
  'bootstrap-5.3.3-dist/css/bootstrap.min.css',
  'bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js',
  'modul/home/index.php',
  'modul/penjualan/index.php',
  'modul/menu/index.php',
  'modul/menu/aksi.php',
  'modul/kasir/index.php',
  'modul/kasir/aksi.php',
  'modul/meja/index.php',
  'modul/meja/aksi.php',
];

// Install event
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(ASSETS);
    })
  );
});

// Fetch event
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
