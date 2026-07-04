# Blueprint Web Desa KKN AIZU

## 1. Ringkasan

Website ini adalah portal desa untuk kebutuhan KKN AIZU. Aplikasi dibuat dengan Laravel 13, Blade, Tailwind CSS, Vite, Neon PostgreSQL, dan admin panel sederhana untuk mengelola konten. Website memiliki dua area utama: halaman publik untuk warga/pengunjung dan admin panel untuk tim pengelola konten.

Inspirasi utama adalah portal desa seperti `https://kersik.desa.id/`, tetapi desain tidak menyalin mentah. Arah visual dibuat modern, bersih, responsif, dan bernuansa desa dengan dominasi hijau alam serta aksen coklat tanah/kayu.

Tujuan utama:

- Menyediakan website publik yang informatif, mudah dibaca, dan nyaman diakses dari handphone.
- Menampilkan profil desa, infografis, peta desa, UMKM, potensi desa, dan galeri.
- Menyediakan admin panel untuk mengelola konten tanpa perlu mengubah seeder setelah website berjalan.
- Tetap menyediakan seeder untuk data awal, placeholder konten, dan akun admin pertama.
- Menyiapkan struktur Laravel yang rapi agar mudah dikembangkan setelah masa KKN.

## 2. Jawaban Soal Google Maps

Bisa, peta dari Google Maps dapat dimasukkan ke website.

Pendekatan default yang direkomendasikan adalah Google My Maps. Google My Maps bisa dipakai untuk membuat peta khusus berisi layer batas desa, kantor desa, fasilitas umum, titik UMKM, potensi desa, lokasi wisata, dan titik penting lain. Setelah peta dibuat dan dibuat publik, peta bisa di-embed ke halaman website menggunakan iframe.

Alur yang disarankan:

1. Buka Google My Maps.
2. Buat peta baru untuk desa.
3. Tambahkan layer, misalnya `Batas Desa`, `Fasilitas Umum`, `UMKM`, `Potensi Desa`, dan `Dokumentasi KKN`.
4. Tambahkan titik lokasi atau garis/poligon wilayah sesuai kebutuhan.
5. Atur sharing menjadi publik atau anyone with the link.
6. Ambil menu embed peta.
7. Simpan URL iframe melalui admin panel pada menu profil desa atau pengaturan peta.
8. Tampilkan iframe tersebut di halaman `/peta-desa`.

Contoh pola embed responsif:

```blade
<div class="overflow-hidden rounded-xl border border-green-100 bg-green-50 shadow-sm">
    <iframe
        src="{{ $mapEmbedUrl }}"
        class="h-[420px] w-full"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        allowfullscreen>
    </iframe>
</div>
```

Catatan:

- Google My Maps cocok untuk kebutuhan KKN karena tidak perlu membangun sistem marker custom.
- Google Maps Embed API atau Maps JavaScript API menjadi opsi lanjutan jika butuh filter marker dinamis, marker dari database secara real-time, styling peta custom, atau interaksi yang lebih kompleks.
- Jika memakai iframe biasa dari Google Maps, itu cukup untuk lokasi kantor desa, tetapi kurang ideal untuk batas wilayah dan banyak titik kategori.

## 3. Stack dan Prinsip Teknis

Stack utama:

- Laravel 13
- Blade templating
- Tailwind CSS
- Vite
- Database: Neon PostgreSQL untuk deploy dan PostgreSQL/SQLite untuk lokal
- Deploy target: Vercel
- Laravel authentication untuk admin panel
- Gambar disimpan sebagai base64 di database, bukan di filesystem server
- Session admin memakai database session agar aman di lingkungan serverless

Prinsip implementasi:

- Public website dapat diakses tanpa login.
- Admin panel hanya dapat diakses setelah login.
- Admin panel mengelola profil desa, infografis, titik peta, UMKM, potensi desa, galeri, kontak, dan pengaturan peta.
- Seeder dipakai untuk data awal, bukan satu-satunya sumber pembaruan konten.
- Karena deploy target adalah Vercel, jangan mengandalkan penyimpanan file permanen di server.
- Semua gambar publik/admin disimpan ke database Neon sebagai base64 agar tetap tersedia di lingkungan serverless.
- Session, cache penting, dan data konten tidak boleh bergantung pada file lokal Vercel.
- SEO-friendly: setiap halaman publik punya title, meta description, dan struktur heading yang jelas.
- Mobile-first: layout publik dan admin tetap nyaman di handphone, tablet, dan desktop.
- Modern village look: dominan hijau, aksen coklat, banyak ruang putih, foto desa yang kuat, kartu informatif, dan navigasi jelas.
- Tidak menyalin desain referensi secara mentah, hanya mengambil pola informasi dan pengalaman portal desa.

## 4. Struktur Halaman Publik dan Route

| Route | Nama Halaman | Controller | Data Utama |
| --- | --- | --- | --- |
| `/` | Beranda | `HomeController@index` | profil, infografis ringkas, peta, UMKM unggulan, potensi unggulan, galeri terbaru |
| `/profil-desa` | Profil Desa | `ProfileController@index` | profil desa, sejarah, visi misi, sambutan, kontak |
| `/infografis` | Infografis | `InfographicController@index` | statistik penduduk, wilayah, ekonomi, fasilitas |
| `/peta-desa` | Peta Desa | `MapController@index` | embed Google My Maps dan daftar titik penting |
| `/umkm` | Daftar UMKM | `MsmeController@index` | daftar UMKM |
| `/umkm/{slug}` | Detail UMKM | `MsmeController@show` | detail satu UMKM |
| `/potensi-desa` | Potensi Desa | `VillagePotentialController@index` | daftar potensi |
| `/potensi-desa/{slug}` | Detail Potensi Desa | `VillagePotentialController@show` | detail satu potensi |
| `/galeri` | Galeri Desa | `GalleryController@index` | daftar foto kegiatan atau dokumentasi |

Route publik harus dapat diakses tanpa autentikasi. Jika data kosong, halaman tetap tampil dengan empty state yang rapi.

Contoh route publik:

```php
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfographicController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MsmeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VillagePotentialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-desa', [ProfileController::class, 'index'])->name('profile');
Route::get('/infografis', [InfographicController::class, 'index'])->name('infographics');
Route::get('/peta-desa', [MapController::class, 'index'])->name('map');
Route::get('/umkm', [MsmeController::class, 'index'])->name('msmes.index');
Route::get('/umkm/{slug}', [MsmeController::class, 'show'])->name('msmes.show');
Route::get('/potensi-desa', [VillagePotentialController::class, 'index'])->name('potentials.index');
Route::get('/potensi-desa/{slug}', [VillagePotentialController::class, 'show'])->name('potentials.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
```

## 5. Struktur Admin Panel dan Route

Admin panel berada di prefix `/admin`. Semua halaman admin, kecuali login, wajib memakai middleware `auth` dan pengecekan role admin.

Admin menu minimum:

- Dashboard
- Profil Desa
- Infografis
- Peta Desa
- UMKM
- Potensi Desa
- Galeri
- Kontak dan Sosial Media
- Pengaturan Website

Route admin minimum:

| Route | Fungsi |
| --- | --- |
| `/admin/login` | Form login admin |
| `/admin` | Dashboard admin |
| `/admin/profil-desa` | Edit profil desa dan link Google My Maps |
| `/admin/infografis` | CRUD data infografis |
| `/admin/peta-desa` | CRUD titik penting dan pengaturan peta |
| `/admin/umkm` | CRUD UMKM |
| `/admin/potensi-desa` | CRUD potensi desa |
| `/admin/galeri` | CRUD galeri |
| `/admin/kontak` | CRUD kontak dan sosial media |
| `/admin/pengaturan` | Pengaturan SEO, nama website, logo, dan favicon |

Contoh route admin:

```php
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\InfographicController as AdminInfographicController;
use App\Http\Controllers\Admin\MapPointController as AdminMapPointController;
use App\Http\Controllers\Admin\MsmeController as AdminMsmeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\VillagePotentialController as AdminVillagePotentialController;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::get('/profil-desa', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil-desa', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::resource('infografis', AdminInfographicController::class)->except(['show']);
        Route::resource('peta-desa', AdminMapPointController::class)->except(['show']);
        Route::resource('umkm', AdminMsmeController::class);
        Route::resource('potensi-desa', AdminVillagePotentialController::class);
        Route::resource('galeri', AdminGalleryController::class)->except(['show']);
        Route::resource('kontak', AdminContactController::class)->except(['show']);
        Route::get('/pengaturan', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/pengaturan', [AdminSettingController::class, 'update'])->name('settings.update');
    });
```

Admin behavior:

- Admin login memakai email dan password.
- Akun admin pertama dibuat lewat seeder dari `.env`, misalnya `ADMIN_EMAIL` dan `ADMIN_PASSWORD`.
- Admin dapat membuat, mengubah, menghapus, mem-publish, dan menyembunyikan konten.
- Delete menggunakan konfirmasi agar tidak mudah terhapus tidak sengaja.
- Form memakai validasi Laravel Form Request.
- Upload gambar dikonversi menjadi data URI base64, disimpan ke kolom `text` di database, lalu ditampilkan langsung sebagai `src` gambar.

Kebijakan gambar base64:

- Simpan gambar sebagai data URI lengkap, misalnya `data:image/webp;base64,...`, agar bisa langsung dipakai di atribut `src`.
- Gunakan kolom PostgreSQL `text` untuk field base64.
- Simpan MIME type, alt text, dan nama file asli sebagai metadata terpisah jika diperlukan.
- Validasi file hanya menerima `jpg`, `jpeg`, `png`, dan `webp`.
- Batasi ukuran upload awal maksimal 2 MB per gambar.
- Optimasi gambar sebelum encode bila memungkinkan: resize sisi terpanjang sekitar 1600 px untuk hero dan 1000 px untuk kartu/galeri.
- Utamakan output `webp` atau JPEG terkompresi agar database tidak cepat membesar.
- Hindari menyimpan file ke `storage/app/public`, karena Vercel tidak dipakai sebagai penyimpanan file permanen.
- Jika nanti konten gambar sangat banyak, opsi lanjutan adalah pindah ke object storage seperti S3/R2/Supabase Storage, tetapi v1 tetap memakai base64 di Neon sesuai kebutuhan deploy.

Format item gambar untuk field JSON seperti `gallery`:

```json
[
  {
    "src": "data:image/webp;base64,...",
    "mime_type": "image/webp",
    "alt": "Foto produk UMKM",
    "original_name": "produk.webp"
  }
]
```

`Base64ImageService` bertanggung jawab untuk:

- Menerima file upload dari request admin.
- Memvalidasi MIME type dan ukuran file.
- Mengoptimasi ukuran gambar bila library image processing tersedia.
- Menghasilkan data URI base64.
- Mengembalikan metadata `mime_type`, `alt`, dan `original_name`.
- Menghapus data gambar lama dari record saat admin mengganti gambar, cukup dengan mengganti nilai kolom database.

## 6. Struktur Data

### `users`

Dipakai untuk login admin.

Field tambahan dari default Laravel:

- `role` dengan nilai minimum `admin`
- `is_active` boolean

### `sessions`

Dipakai untuk session login admin di environment Vercel.

Gunakan session table bawaan Laravel dengan `SESSION_DRIVER=database`. Jangan memakai file session sebagai default deploy karena filesystem Vercel tidak ditujukan untuk state permanen.

### `village_profiles`

Menyimpan identitas utama desa.

Field minimum:

- `id`
- `name`
- `tagline`
- `district`
- `regency`
- `province`
- `postal_code`
- `area`
- `head_name`
- `head_greeting`
- `history`
- `vision`
- `missions` sebagai JSON
- `address`
- `phone`
- `email`
- `hero_image_base64`
- `hero_image_mime_type`
- `hero_image_alt`
- `logo_base64`
- `logo_mime_type`
- `map_embed_url`
- `social_links` sebagai JSON
- `created_at`
- `updated_at`

### `infographics`

Menyimpan angka atau ringkasan statistik.

Field minimum:

- `id`
- `category`
- `title`
- `value`
- `unit`
- `description`
- `icon`
- `sort_order`
- `is_featured`
- `is_published`
- `created_at`
- `updated_at`

Contoh kategori:

- Kependudukan
- Wilayah
- Pendidikan
- Kesehatan
- Ekonomi
- Fasilitas

### `map_points`

Menyimpan daftar titik penting untuk ditampilkan sebagai daftar pendamping peta. Peta utamanya tetap dari Google My Maps.

Field minimum:

- `id`
- `name`
- `category`
- `latitude`
- `longitude`
- `address`
- `description`
- `external_url`
- `sort_order`
- `is_featured`
- `is_published`
- `created_at`
- `updated_at`

Contoh kategori:

- Kantor desa
- Fasilitas umum
- Pendidikan
- Kesehatan
- UMKM
- Potensi desa
- Wisata
- Lainnya

### `msmes`

Menyimpan data UMKM.

Field minimum:

- `id`
- `name`
- `slug`
- `owner_name`
- `category`
- `description`
- `products`
- `address`
- `phone`
- `whatsapp`
- `image_base64`
- `image_mime_type`
- `image_alt`
- `gallery` sebagai JSON berisi item base64
- `map_url`
- `is_featured`
- `is_published`
- `created_at`
- `updated_at`

### `village_potentials`

Menyimpan potensi desa seperti pertanian, wisata, budaya, lingkungan, industri kreatif, atau sumber daya lokal.

Field minimum:

- `id`
- `title`
- `slug`
- `category`
- `summary`
- `description`
- `location`
- `image_base64`
- `image_mime_type`
- `image_alt`
- `gallery` sebagai JSON berisi item base64
- `is_featured`
- `is_published`
- `created_at`
- `updated_at`

### `galleries`

Menyimpan dokumentasi kegiatan dan foto desa.

Field minimum:

- `id`
- `title`
- `description`
- `image_base64`
- `image_mime_type`
- `image_alt`
- `category`
- `taken_at`
- `sort_order`
- `is_published`
- `created_at`
- `updated_at`

### `contacts`

Menyimpan kontak publik dan link penting.

Field minimum:

- `id`
- `label`
- `type`
- `value`
- `url`
- `sort_order`
- `is_published`
- `created_at`
- `updated_at`

Contoh `type`:

- `phone`
- `email`
- `address`
- `facebook`
- `instagram`
- `youtube`
- `whatsapp`
- `important_number`

### `site_settings`

Menyimpan pengaturan umum website.

Field minimum:

- `id`
- `key`
- `value`
- `type`
- `created_at`
- `updated_at`

Contoh key:

- `site_name`
- `site_description`
- `meta_keywords`
- `logo_base64`
- `favicon_base64`
- `footer_text`
- `primary_color`
- `accent_color`

## 7. Struktur Tampilan Publik

Layout utama:

- Header modern dengan logo/nama desa, menu navigasi, tombol menuju peta, dan mobile drawer.
- Hero visual dengan foto desa, overlay hijau lembut, nama desa, lokasi administratif, dan CTA.
- Section full-width yang bersih, bukan tumpukan kartu berlebihan.
- Footer berisi alamat desa, kontak, sosial media, link halaman, dan kredit KKN AIZU.

Halaman beranda:

1. Hero desa dengan foto utama, nama desa, kecamatan/kabupaten/provinsi, dan CTA ke profil/peta.
2. Quick links ke fitur utama.
3. Sambutan kepala desa atau pengantar singkat.
4. Infografis ringkas dalam kartu statistik.
5. Preview peta desa dengan tombol ke halaman peta.
6. UMKM unggulan.
7. Potensi desa unggulan.
8. Galeri terbaru.
9. Footer kontak.

Halaman profil desa:

- Identitas desa.
- Sejarah singkat.
- Visi dan misi.
- Sambutan kepala desa.
- Informasi lokasi dan kontak.

Halaman infografis:

- Kartu statistik per kategori.
- Data tampil hanya jika `is_published = true`.
- Empty state jika belum ada data publik.

Halaman peta desa:

- Embed Google My Maps responsif.
- Daftar titik penting di bawah atau samping peta.
- Tombol buka peta di Google Maps atau My Maps.

Halaman UMKM:

- Grid kartu UMKM.
- Filter kategori sederhana di sisi frontend boleh ditambahkan jika datanya banyak.
- Detail UMKM menampilkan produk, kontak, alamat, foto, dan link WhatsApp.

Halaman potensi desa:

- Grid kartu potensi.
- Detail potensi menampilkan ringkasan, deskripsi, lokasi, dan galeri pendukung.

Halaman galeri:

- Grid foto responsif.
- Kategori dokumentasi, kegiatan KKN, fasilitas, UMKM, atau potensi desa.

## 8. Struktur Tampilan Admin

Admin panel harus terasa modern, rapi, dan cepat dipakai.

Layout admin:

- Sidebar desktop berwarna hijau tua dengan aksen coklat.
- Topbar berisi judul halaman, nama admin, dan tombol logout.
- Mobile layout memakai drawer/sidebar collapse.
- Dashboard berisi kartu ringkasan jumlah UMKM, potensi, galeri, infografis, dan status konten.
- Tabel data memakai search sederhana, pagination, status publish, tombol edit, dan tombol hapus.
- Form memakai input yang jelas, label konsisten, helper text, validasi error, dan preview gambar.

Komponen admin minimum:

- `components.admin.layout`
- `components.admin.sidebar`
- `components.admin.topbar`
- `components.admin.table`
- `components.admin.form-section`
- `components.admin.base64-image-upload`
- `components.admin.status-badge`
- `components.admin.confirm-delete`

## 9. Komponen Blade Publik yang Disarankan

Gunakan komponen Blade agar tampilan konsisten.

Komponen minimum:

- `components.layout.public`
- `components.site.header`
- `components.site.footer`
- `components.section-heading`
- `components.stat-card`
- `components.feature-card`
- `components.content-card`
- `components.empty-state`
- `components.responsive-map`

Contoh empty state:

```blade
<div class="rounded-xl border border-dashed border-green-200 bg-green-50 p-8 text-center">
    <p class="text-sm font-semibold text-green-900">{{ $title ?? 'Belum ada data' }}</p>
    <p class="mt-2 text-sm text-green-700">{{ $description ?? 'Konten akan ditampilkan setelah data tersedia.' }}</p>
</div>
```

## 10. Arah Visual Tailwind

Karakter visual:

- Modern, bersih, dan terasa seperti portal desa yang profesional.
- Dominan hijau alam, hijau sawah, dan hijau tua untuk identitas desa.
- Aksen coklat tanah/kayu untuk memberi kesan lokal, hangat, dan natural.
- Background memakai putih, hijau sangat muda, atau stone muda agar konten mudah dibaca.
- Foto desa, UMKM, dan kegiatan harus menjadi elemen visual utama.

Token warna yang disarankan:

- Primary: `green-700` atau `emerald-700`
- Primary dark: `green-900`
- Primary soft: `green-50` atau `emerald-50`
- Accent: `amber-800`, `stone-700`, atau warna coklat custom `#7A4E2D`
- Accent soft: `amber-50` atau `stone-100`
- Text: `slate-900`
- Muted text: `slate-600`
- Border: `green-100`, `stone-200`, atau `slate-200`
- Background: `white`, `green-50`, `stone-50`

Pola UI publik:

- Hero modern dengan foto full-width, overlay hijau transparan, dan tipografi besar.
- Section berjarak lega, tetapi tetap padat informasi.
- Kartu statistik dengan ikon sederhana dan angka besar.
- Kartu UMKM dan potensi memakai foto yang jelas, badge kategori, dan CTA.
- Galeri memakai rasio gambar konsisten seperti `aspect-[4/3]`.
- Tombol utama hijau tua, tombol sekunder outline hijau/coklat.
- Gunakan `rounded-xl` secukupnya, shadow lembut, dan border tipis agar modern tanpa terlihat terlalu ramai.

Pola UI admin:

- Admin memakai tampilan lebih fungsional: sidebar gelap hijau, background `stone-50`, panel putih, tabel bersih.
- Hindari hero besar di admin.
- Gunakan badge warna untuk status publish/draft.
- Tombol destructive memakai merah, bukan coklat.
- Form panjang dibagi menjadi beberapa section agar mudah dipindai.

## 11. Seeder dan Placeholder Konten

Seeder harus menyediakan data awal yang cukup agar website terlihat hidup saat pertama dijalankan dan admin bisa langsung mencoba panel.

Data placeholder minimum:

- 1 akun admin dari env.
- 1 profil desa.
- 6 sampai 8 data infografis.
- 5 sampai 10 titik peta.
- 4 sampai 6 UMKM.
- 3 sampai 5 potensi desa.
- 8 sampai 12 foto galeri.
- Kontak desa dan sosial media placeholder.
- Pengaturan website dasar.

Seeder sebaiknya idempotent memakai `updateOrCreate` agar aman dijalankan ulang.

Contoh env admin:

```env
ADMIN_NAME="Admin Desa"
ADMIN_EMAIL="admin@desa.test"
ADMIN_PASSWORD="change-this-password"
```

Contoh placeholder yang perlu diganti tim KKN:

- Nama desa
- Nama kepala desa
- Sejarah desa
- Visi misi
- Jumlah penduduk
- Luas wilayah
- Kontak desa
- Foto desa
- Foto UMKM
- Link Google My Maps
- Logo dan favicon

## 12. Struktur Folder yang Disarankan

Struktur Laravel tetap mengikuti default framework. Tambahan utama:

```text
app/
  Http/
    Controllers/
      Admin/
        ContactController.php
        DashboardController.php
        GalleryController.php
        InfographicController.php
        MapPointController.php
        MsmeController.php
        ProfileController.php
        SettingController.php
        VillagePotentialController.php
      Auth/
      GalleryController.php
      HomeController.php
      InfographicController.php
      MapController.php
      MsmeController.php
      ProfileController.php
      VillagePotentialController.php
    Middleware/
      EnsureUserIsAdmin.php
    Requests/
      Admin/
        StoreMsmeRequest.php
        UpdateMsmeRequest.php
        StoreVillagePotentialRequest.php
        UpdateVillagePotentialRequest.php
  Services/
    Base64ImageService.php
  Models/
    Contact.php
    Gallery.php
    Infographic.php
    MapPoint.php
    Msme.php
    SiteSetting.php
    User.php
    VillageProfile.php
    VillagePotential.php
database/
  migrations/
  seeders/
    AdminUserSeeder.php
    VillageProfileSeeder.php
    InfographicSeeder.php
    MapPointSeeder.php
    MsmeSeeder.php
    VillagePotentialSeeder.php
    GallerySeeder.php
    ContactSeeder.php
    SiteSettingSeeder.php
resources/
  views/
    admin/
      dashboard.blade.php
      profile/
      infographics/
      map-points/
      msmes/
      potentials/
      galleries/
      contacts/
      settings/
    components/
      admin/
      site/
    layouts/
    pages/
      home.blade.php
      profile.blade.php
      infographics.blade.php
      map.blade.php
      msmes/
      potentials/
      gallery.blade.php
```

## 13. Acceptance Criteria

Website dianggap selesai untuk v1 jika:

- Semua route publik dapat dibuka tanpa login.
- Admin dapat login melalui `/admin/login` atau route login admin yang setara.
- Admin panel hanya bisa dibuka oleh user dengan role admin.
- Admin dapat mengelola profil desa, infografis, titik peta, UMKM, potensi desa, galeri, kontak, dan pengaturan website.
- Admin dapat mengunggah gambar yang disimpan sebagai base64 di Neon PostgreSQL.
- Beranda menampilkan data yang dibuat dari admin atau seeder.
- Halaman profil, infografis, peta, UMKM, potensi, dan galeri tersedia.
- Halaman detail UMKM dan potensi dapat dibuka berdasarkan slug.
- Konten yang belum dipublish tidak tampil di halaman publik.
- Peta Google My Maps tampil responsif.
- Empty state tampil jika data UMKM, potensi, atau galeri kosong.
- Tampilan publik modern, responsif, dominan hijau, dan memakai aksen coklat.
- Tampilan admin rapi, fungsional, dan nyaman dipakai di desktop maupun mobile.

## 14. Test Plan

Feature test publik:

- `GET /` mengembalikan status 200.
- `GET /profil-desa` mengembalikan status 200.
- `GET /infografis` mengembalikan status 200.
- `GET /peta-desa` mengembalikan status 200.
- `GET /umkm` mengembalikan status 200.
- `GET /umkm/{slug}` mengembalikan status 200 untuk slug published.
- `GET /potensi-desa` mengembalikan status 200.
- `GET /potensi-desa/{slug}` mengembalikan status 200 untuk slug published.
- `GET /galeri` mengembalikan status 200.
- Slug yang tidak ditemukan atau belum published mengembalikan 404.

Feature test admin:

- Guest yang membuka `/admin` diarahkan ke login.
- Admin valid bisa login.
- User non-admin tidak bisa membuka admin panel.
- Admin bisa membuat, mengubah, dan menghapus data UMKM.
- Admin bisa membuat, mengubah, dan menghapus data potensi desa.
- Admin bisa mengubah profil desa dan link Google My Maps.
- Admin bisa upload gambar, gambar tersimpan sebagai data URI base64, dan gambar tampil di halaman publik.
- Aplikasi tidak membutuhkan `storage:link` untuk menampilkan gambar.
- Logout admin berhasil dan session selesai.

Data test:

- Seeder dapat dijalankan ulang tanpa duplikasi data besar.
- Akun admin pertama dibuat dari env.
- Session admin tersimpan di database.
- Beranda tetap tampil jika sebagian data kosong.
- Empty state tampil saat koleksi data kosong.
- Konten draft tidak tampil di publik.
- Field gambar berisi data URI base64 yang valid.

UI manual test:

- Cek tampilan publik di mobile sekitar 375 px.
- Cek tampilan publik di tablet sekitar 768 px.
- Cek tampilan publik di desktop sekitar 1280 px.
- Cek menu mobile bisa dibuka dan ditutup.
- Cek iframe peta tidak melebar keluar layar.
- Cek gambar kartu tidak merusak layout walau ukuran gambar berbeda-beda.
- Cek dashboard admin di desktop dan mobile.
- Cek form admin dengan error validasi.
- Cek palet warna: website harus dominan hijau desa dengan aksen coklat, bukan biru/slate generik.

## 15. Rencana Implementasi Singkat

1. Inisialisasi proyek Laravel 13 dan Tailwind CSS.
2. Pasang atau buat auth admin berbasis Blade.
3. Tambahkan kolom role dan middleware admin.
4. Buat migration untuk semua entity publik, admin-managed content, dan site settings.
5. Buat model Eloquent, relationship yang diperlukan, dan seeder dasar.
6. Daftarkan route publik dan route admin.
7. Buat controller publik untuk setiap halaman.
8. Buat controller admin CRUD untuk setiap modul.
9. Buat layout publik modern bernuansa hijau dan coklat.
10. Buat layout admin dengan sidebar, topbar, dashboard, tabel, form, dan upload gambar base64.
11. Tambahkan responsive Google My Maps embed.
12. Tambahkan empty state dan handling konten draft/published.
13. Jalankan seeder, feature test, dan cek responsivitas manual.

## 16. Catatan Deploy

Target deploy adalah Vercel dengan database Neon PostgreSQL.

Konfigurasi environment minimum:

- `APP_KEY`
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL`
- `DATABASE_URL` atau konfigurasi koneksi PostgreSQL Neon setara
- `SESSION_DRIVER=database`
- `ADMIN_NAME`
- `ADMIN_EMAIL`
- `ADMIN_PASSWORD`

Checklist deploy:

- Jalankan `composer install --no-dev --optimize-autoloader`.
- Jalankan `npm ci` dan `npm run build`.
- Set semua environment variable di dashboard Vercel.
- Pastikan migration mencakup tabel `sessions` untuk database session.
- Jalankan `php artisan migrate --seed --force` pada tahap release/deploy yang sesuai.
- Jangan menjalankan `php artisan storage:link` untuk gambar, karena gambar disimpan sebagai base64 di Neon.
- Jalankan cache Laravel: `php artisan config:cache`, `route:cache`, dan `view:cache` jika kompatibel dengan setup Vercel yang dipakai.
- Setelah deploy pertama, ganti password admin dari panel atau command khusus jika tersedia.

Dengan admin panel, pembaruan konten utama dilakukan dari browser oleh admin. Seeder tetap dipakai untuk bootstrap data awal, demo content, dan recovery bila database baru dibuat.
