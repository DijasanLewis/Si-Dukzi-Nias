import './bootstrap';

import Alpine from 'alpinejs';
import Toast from 'alpinejs-toaster';      // Untuk notifikasi
import Clipboard from '@alpinejs/clipboard'; // Untuk copy-paste
import Fuse from 'fuse.js';                // Untuk fuzzy search

// Membuat library tersedia secara global untuk Alpine di file Blade
window.Alpine = Alpine;
window.Fuse = Fuse;

// Mendaftarkan plugin
Alpine.plugin(Toast);
Alpine.plugin(Clipboard);

// Memulai Alpine
Alpine.start();
