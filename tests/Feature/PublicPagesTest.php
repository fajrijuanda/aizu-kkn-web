<?php

namespace Tests\Feature;

use App\Models\Msme;
use App\Models\VillagePotential;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_public_pages_are_accessible(): void
    {
        $msme = Msme::query()->firstOrFail();
        $potential = VillagePotential::query()->firstOrFail();

        $paths = [
            '/',
            '/profil-desa',
            '/infografis',
            '/peta-desa',
            '/umkm',
            '/umkm/'.$msme->slug,
            '/potensi-desa',
            '/potensi-desa/'.$potential->slug,
            '/galeri',
        ];

        foreach ($paths as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_unpublished_detail_pages_return_not_found(): void
    {
        $msme = Msme::query()->create([
            'name' => 'Draft UMKM',
            'slug' => 'draft-umkm',
            'is_published' => false,
        ]);

        $potential = VillagePotential::query()->create([
            'title' => 'Draft Potensi',
            'slug' => 'draft-potensi',
            'is_published' => false,
        ]);

        $this->get('/umkm/'.$msme->slug)->assertNotFound();
        $this->get('/potensi-desa/'.$potential->slug)->assertNotFound();
    }
}
