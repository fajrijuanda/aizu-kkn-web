<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Infographic;
use App\Models\MapPoint;
use App\Models\Msme;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\VillagePotential;
use App\Models\VillageProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@desa.test')],
            [
                'name' => env('ADMIN_NAME', 'Admin Desa'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
                'role' => 'admin',
                'is_active' => true,
            ],
        );

        $heroImage = $this->svgData('Desa KKN AIZU', '#14532d', '#f5f5dc');
        $umkmImage = $this->svgData('UMKM Desa', '#166534', '#fff7ed');
        $potensiImage = $this->svgData('Potensi Desa', '#7A4E2D', '#ecfccb');
        $galleryImage = $this->svgData('Galeri Desa', '#365314', '#fefce8');
        $logo = $this->svgData('AIZU', '#14532d', '#ffffff', 420, 420);

        VillageProfile::query()->updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Desa KKN AIZU',
                'tagline' => 'Desa hijau, mandiri, dan penuh potensi lokal',
                'district' => 'Kecamatan Contoh',
                'regency' => 'Kabupaten Contoh',
                'province' => 'Provinsi Contoh',
                'postal_code' => '00000',
                'area' => '1.250 ha',
                'head_name' => 'Bapak/Ibu Kepala Desa',
                'head_greeting' => 'Selamat datang di portal Desa KKN AIZU. Website ini menjadi ruang informasi publik untuk mengenalkan profil, potensi, UMKM, dan dokumentasi kegiatan desa.',
                'history' => 'Desa KKN AIZU merupakan desa dengan karakter agraris dan sosial yang kuat. Konten sejarah ini masih berupa placeholder dan dapat diperbarui melalui admin panel.',
                'vision' => 'Mewujudkan desa yang hijau, mandiri, transparan, dan berdaya melalui informasi publik yang mudah diakses.',
                'missions' => [
                    'Meningkatkan kualitas informasi publik desa.',
                    'Mendukung promosi UMKM dan potensi lokal.',
                    'Menyajikan data desa secara ringkas, jelas, dan mudah dipahami.',
                    'Mendorong partisipasi warga melalui kanal digital.',
                ],
                'address' => 'Jalan Utama Desa, Kecamatan Contoh, Kabupaten Contoh',
                'phone' => '0800-0000-0000',
                'email' => 'kontak@desa.test',
                'hero_image_base64' => $heroImage,
                'hero_image_mime_type' => 'image/svg+xml',
                'hero_image_alt' => 'Pemandangan Desa KKN AIZU',
                'logo_base64' => $logo,
                'logo_mime_type' => 'image/svg+xml',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=',
                'social_links' => [
                    'instagram' => 'https://instagram.com/',
                    'facebook' => 'https://facebook.com/',
                    'youtube' => 'https://youtube.com/',
                ],
            ],
        );

        $infographics = [
            ['Kependudukan', 'Penduduk', '2.480', 'jiwa', 'Estimasi total penduduk desa', 'users', 1, true],
            ['Kependudukan', 'Kepala Keluarga', '715', 'KK', 'Jumlah keluarga terdata', 'home', 2, true],
            ['Wilayah', 'Luas Wilayah', '1.250', 'ha', 'Luas wilayah administratif', 'map', 3, true],
            ['Ekonomi', 'UMKM Aktif', '24', 'unit', 'Pelaku usaha lokal', 'store', 4, true],
            ['Fasilitas', 'Fasilitas Umum', '18', 'titik', 'Sekolah, posyandu, masjid, dan balai desa', 'building', 5, false],
            ['Pertanian', 'Lahan Produktif', '640', 'ha', 'Area sawah, kebun, dan komoditas lokal', 'leaf', 6, false],
        ];

        foreach ($infographics as [$category, $title, $value, $unit, $description, $icon, $sortOrder, $featured]) {
            Infographic::query()->updateOrCreate(
                ['title' => $title],
                compact('category', 'value', 'unit', 'description', 'icon') + [
                    'sort_order' => $sortOrder,
                    'is_featured' => $featured,
                    'is_published' => true,
                ],
            );
        }

        $mapPoints = [
            ['Kantor Desa', 'Kantor desa', -6.2000000, 106.8166660, 'Pusat pelayanan administrasi desa'],
            ['Balai Warga', 'Fasilitas umum', -6.2010000, 106.8170000, 'Ruang kegiatan dan musyawarah warga'],
            ['Posyandu Melati', 'Kesehatan', -6.2020000, 106.8180000, 'Layanan kesehatan ibu dan anak'],
            ['SD Negeri Desa', 'Pendidikan', -6.2030000, 106.8190000, 'Fasilitas pendidikan dasar'],
            ['Sentra UMKM', 'UMKM', -6.2040000, 106.8200000, 'Area usaha dan produk lokal'],
        ];

        foreach ($mapPoints as $index => [$name, $category, $latitude, $longitude, $description]) {
            MapPoint::query()->updateOrCreate(
                ['name' => $name],
                [
                    'category' => $category,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'address' => 'Area Desa KKN AIZU',
                    'description' => $description,
                    'external_url' => null,
                    'sort_order' => $index + 1,
                    'is_featured' => $index < 3,
                    'is_published' => true,
                ],
            );
        }

        $msmes = [
            ['Kopi Kebun AIZU', 'kopi-kebun-aizu', 'Ibu Sari', 'Kuliner', 'Produk kopi robusta lokal yang diolah oleh warga desa.', 'Kopi bubuk, drip bag, paket oleh-oleh'],
            ['Keripik Singkong Makmur', 'keripik-singkong-makmur', 'Pak Budi', 'Makanan ringan', 'Keripik singkong renyah dengan varian rasa pedas, balado, dan original.', 'Keripik singkong, keripik pisang'],
            ['Anyaman Bambu Lestari', 'anyaman-bambu-lestari', 'Ibu Wati', 'Kerajinan', 'Produk anyaman bambu untuk kebutuhan rumah tangga dan suvenir.', 'Bakul, tampah, hiasan dinding'],
            ['Madu Tani Hijau', 'madu-tani-hijau', 'Pak Rahmat', 'Produk alami', 'Madu lokal dari kawasan kebun desa.', 'Madu botol, paket hampers'],
        ];

        foreach ($msmes as $index => [$name, $slug, $owner, $category, $description, $products]) {
            Msme::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'owner_name' => $owner,
                    'category' => $category,
                    'description' => $description,
                    'products' => $products,
                    'address' => 'Dusun Contoh, Desa KKN AIZU',
                    'phone' => '0800-0000-0000',
                    'whatsapp' => '6280000000000',
                    'image_base64' => $umkmImage,
                    'image_mime_type' => 'image/svg+xml',
                    'image_alt' => $name,
                    'gallery' => [],
                    'map_url' => null,
                    'is_featured' => $index < 3,
                    'is_published' => true,
                ],
            );
        }

        $potentials = [
            ['Pertanian Organik', 'pertanian-organik', 'Pertanian', 'Lahan produktif dengan komoditas sayur, padi, dan palawija.', 'Potensi pertanian desa dapat dikembangkan menjadi edukasi tani dan rantai pasok produk segar.'],
            ['Wisata Alam Sungai', 'wisata-alam-sungai', 'Wisata', 'Aliran sungai dan area hijau yang cocok untuk aktivitas rekreasi warga.', 'Potensi wisata alam ini membutuhkan penataan akses, kebersihan, dan narasi promosi yang kuat.'],
            ['Kerajinan Bambu', 'kerajinan-bambu', 'Industri kreatif', 'Ketersediaan bambu lokal mendukung produk kerajinan bernilai jual.', 'Produk bambu dapat diarahkan menjadi suvenir desa dan komoditas kreatif.'],
        ];

        foreach ($potentials as $index => [$title, $slug, $category, $summary, $description]) {
            VillagePotential::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'category' => $category,
                    'summary' => $summary,
                    'description' => $description,
                    'location' => 'Desa KKN AIZU',
                    'image_base64' => $potensiImage,
                    'image_mime_type' => 'image/svg+xml',
                    'image_alt' => $title,
                    'gallery' => [],
                    'is_featured' => $index < 3,
                    'is_published' => true,
                ],
            );
        }

        foreach (range(1, 9) as $index) {
            Gallery::query()->updateOrCreate(
                ['title' => 'Dokumentasi Desa '.$index],
                [
                    'description' => 'Placeholder dokumentasi kegiatan dan suasana desa.',
                    'image_base64' => $galleryImage,
                    'image_mime_type' => 'image/svg+xml',
                    'image_alt' => 'Dokumentasi Desa '.$index,
                    'category' => $index % 2 === 0 ? 'Kegiatan KKN' : 'Desa',
                    'taken_at' => now()->subDays($index),
                    'sort_order' => $index,
                    'is_published' => true,
                ],
            );
        }

        $contacts = [
            ['Telepon Desa', 'phone', '0800-0000-0000', null, 1],
            ['Email Desa', 'email', 'kontak@desa.test', 'mailto:kontak@desa.test', 2],
            ['Alamat Kantor', 'address', 'Jalan Utama Desa, Kecamatan Contoh', null, 3],
            ['Instagram', 'instagram', '@desakkn_aizu', 'https://instagram.com/', 4],
            ['WhatsApp Admin', 'whatsapp', '6280000000000', 'https://wa.me/6280000000000', 5],
        ];

        foreach ($contacts as [$label, $type, $value, $url, $sortOrder]) {
            Contact::query()->updateOrCreate(
                ['label' => $label],
                [
                    'type' => $type,
                    'value' => $value,
                    'url' => $url,
                    'sort_order' => $sortOrder,
                    'is_published' => true,
                ],
            );
        }

        $settings = [
            'site_name' => 'Web Desa KKN AIZU',
            'site_description' => 'Portal informasi publik desa, UMKM, potensi, peta, dan dokumentasi kegiatan KKN AIZU.',
            'meta_keywords' => 'desa, kkn, aizu, umkm, potensi desa',
            'footer_text' => 'Dikelola oleh Tim KKN AIZU',
            'primary_color' => '#166534',
            'accent_color' => '#7A4E2D',
            'favicon_base64' => $logo,
            'logo_base64' => $logo,
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => str_contains($key, 'base64') ? 'image' : 'text',
                ],
            );
        }
    }

    private function svgData(string $title, string $background, string $foreground, int $width = 1200, int $height = 800): string
    {
        $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="$width" height="$height" viewBox="0 0 $width $height">
  <rect width="100%" height="100%" fill="$background"/>
  <path d="M0 $height C260 580 430 610 650 430 C820 290 990 310 $width 190 L$width $height Z" fill="#ffffff" opacity=".14"/>
  <circle cx="180" cy="160" r="92" fill="#f59e0b" opacity=".88"/>
  <path d="M0 620 C220 520 360 540 520 600 C740 685 890 590 $width 530 L$width $height L0 $height Z" fill="#052e16" opacity=".32"/>
  <text x="50%" y="52%" dominant-baseline="middle" text-anchor="middle" fill="$foreground" font-family="Arial, sans-serif" font-size="58" font-weight="700">$safeTitle</text>
</svg>
SVG;

        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }
}
