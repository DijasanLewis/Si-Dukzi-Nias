import './bootstrap';

// // import Alpine from 'alpinejs';
// import 'alpine-toast';      // Untuk notifikasi
// import Clipboard from '@ryangjchandler/alpine-clipboard'; // Untuk copy-paste
import Fuse from 'fuse.js';                // Untuk fuzzy search
import '../../public/js/filament/notifications/notifications.js';

// Membuat library tersedia secara global untuk Alpine di file Blade
// window.Alpine = Alpine;
window.Fuse = Fuse;

// Mendaftarkan semua plugin yang dibutuhkan
// Alpine.plugin(Clipboard);

// Memulai Alpine
// Alpine.start();