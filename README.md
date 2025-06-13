Gian Motors adalah aplikasi web berbasis framework Laravel yang dirancang sebagai sistem manajemen bengkel motor yang komprehensif. Aplikasi ini memfasilitasi interaksi antara pelanggan dan admin bengkel, dengan fitur-fitur yang mencakup manajemen produk, layanan servis, pemesanan, hingga pengumpulan feedback dari pelanggan.

Aplikasi ini dibangun menggunakan Laravel versi 11  dan memanfaatkan berbagai teknologi modern seperti Vite untuk asset bundling , serta Tailwind CSS untuk desain antarmuka yang responsif dan modern.



Fitur Utama Aplikasi:
Aplikasi Gian Motors memiliki serangkaian fitur yang terbagi untuk dua jenis pengguna utama: Pelanggan dan Admin.

Untuk Pelanggan:

Autentikasi Pengguna: Pelanggan dapat melakukan registrasi, login, logout, serta melakukan reset password jika lupa.

Dashboard Pengguna: Setelah login, pelanggan akan disambut di halaman dashboard yang memberikan akses cepat ke berbagai fitur seperti booking servis, melihat layanan, dan memberikan feedback.
Manajemen Profil: Pengguna dapat memperbarui informasi profil mereka, termasuk nama, email, alamat, dan nomor telepon.
Katalog Produk: Pelanggan dapat melihat daftar produk atau suku cadang yang tersedia di bengkel, lengkap dengan deskripsi, harga, dan gambar.

Pemesanan Produk (Online Ordering): Pelanggan dapat memesan produk secara langsung melalui aplikasi, mengatur jumlah, mengisi alamat pengiriman, dan memilih metode pembayaran (transfer atau COD). Pelanggan juga dapat melihat riwayat pesanan mereka.


Booking Servis: Fitur ini memungkinkan pelanggan untuk melakukan booking servis motor secara online melalui beberapa langkah mudah:
Mengisi data motor (merk, model, tahun, nomor plat).




Memilih jenis layanan yang dibutuhkan.

Menentukan jadwal dan memberikan catatan keluhan.


Riwayat Booking: Pelanggan dapat melihat riwayat booking servis yang pernah dilakukan.

Sistem Feedback: Pelanggan dapat memberikan rating dan komentar mengenai layanan yang telah diterima, yang akan ditampilkan secara publik di halaman feedback.


Untuk Admin:

Dashboard Admin: Admin memiliki halaman dashboard khusus yang menampilkan ringkasan statistik seperti jumlah produk, layanan, pesanan, dan feedback.
Manajemen Produk (CRUD): Admin memiliki hak akses penuh untuk menambah, melihat, memperbarui, dan menghapus produk dari katalog.




Manajemen Pesanan: Admin dapat melihat semua pesanan yang masuk dari pelanggan dan memperbarui status pesanan (misalnya: dari 'pending' menjadi 'confirmed', 'shipped', dll.).


Manajemen Booking Servis: Admin dapat memantau dan mengelola semua jadwal booking yang dibuat oleh pelanggan, termasuk mengubah status booking (misalnya: dari 'pending' menjadi 'processing' atau 'finished').

Manajemen Feedback: Admin memiliki wewenang untuk menghapus feedback yang dianggap tidak sesuai.

Struktur dan Teknologi:
Backend: Dibangun dengan PHP 8.2  dan Laravel 11, mengikuti pola desain Model-View-Controller (MVC).
Frontend: Menggunakan Blade sebagai templating engine, Tailwind CSS  untuk styling, dan Alpine.js  untuk interaktivitas dinamis pada antarmuka.

Database: Aplikasi ini menggunakan SQLite sebagai database default  dan menyertakan migrasi untuk membuat semua tabel yang diperlukan, seperti users, produks, orders, bookings, servis, dan feedbacks.

API: Terdapat juga implementasi API sederhana untuk menampilkan data produk dalam format JSON, yang menunjukkan potensi aplikasi ini untuk diintegrasikan dengan sistem lain.
Keamanan: Aplikasi ini mengimplementasikan sistem Policy dan Gate dari Laravel untuk mengatur hak akses pengguna, memastikan bahwa hanya admin yang dapat mengakses fitur-fitur manajemen.


Secara keseluruhan, Gian Motors adalah sebuah aplikasi yang solid dan fungsional, dirancang untuk mendigitalkan operasional sebuah bengkel motor dan meningkatkan pengalaman pelanggan.
