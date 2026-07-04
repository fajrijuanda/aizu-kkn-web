# Web Desa KKN AIZU

Portal desa berbasis Laravel 13, Blade, Tailwind CSS, admin panel, dan penyimpanan gambar base64 di database. Project ini disiapkan untuk deploy ke Vercel dengan database Neon PostgreSQL.

## Fitur

- Halaman publik: beranda, profil desa, infografis, peta desa, UMKM, potensi desa, dan galeri.
- Admin panel di `/admin` untuk mengelola konten.
- Auth admin sederhana dengan role `admin`.
- Google My Maps embed untuk halaman peta desa.
- Gambar disimpan sebagai data URI base64 di database, bukan di filesystem.
- Seeder berisi data demo dan akun admin pertama.

## Setup Lokal

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

Default admin lokal dari seeder:

- Email: `admin@desa.test`
- Password: `password`

Ganti `ADMIN_EMAIL` dan `ADMIN_PASSWORD` di environment sebelum deploy produksi.

## Deploy Notes

Environment penting untuk Vercel + Neon:

```env
APP_KEY=
APP_ENV=production
APP_DEBUG=false
APP_URL=
DB_CONNECTION=pgsql
DATABASE_URL=
SESSION_DRIVER=database
ADMIN_NAME="Admin Desa"
ADMIN_EMAIL=
ADMIN_PASSWORD=
```

Jalankan migration dan seeder pada database Neon:

```bash
php artisan migrate --seed --force
```

Project memakai `vercel.json` dan entrypoint `api/index.php` untuk runtime PHP di Vercel. Gambar tidak membutuhkan `storage:link` karena disimpan sebagai base64 di database.

## Verifikasi

```bash
php artisan test
npm run build
```
