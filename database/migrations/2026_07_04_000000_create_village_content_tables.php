<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('village_profiles', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('district')->nullable();
            $table->string('regency')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('area')->nullable();
            $table->string('head_name')->nullable();
            $table->text('head_greeting')->nullable();
            $table->text('history')->nullable();
            $table->text('vision')->nullable();
            $table->json('missions')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('hero_image_base64')->nullable();
            $table->string('hero_image_mime_type')->nullable();
            $table->string('hero_image_alt')->nullable();
            $table->text('logo_base64')->nullable();
            $table->string('logo_mime_type')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });

        Schema::create('infographics', function (Blueprint $table): void {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->string('value');
            $table->string('unit')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('map_points', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->text('external_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('msmes', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('owner_name')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->text('products')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('image_base64')->nullable();
            $table->string('image_mime_type')->nullable();
            $table->string('image_alt')->nullable();
            $table->json('gallery')->nullable();
            $table->text('map_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('village_potentials', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->text('image_base64')->nullable();
            $table->string('image_mime_type')->nullable();
            $table->string('image_alt')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('image_base64')->nullable();
            $table->string('image_mime_type')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('category')->nullable();
            $table->date('taken_at')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table): void {
            $table->id();
            $table->string('label');
            $table->string('type');
            $table->text('value')->nullable();
            $table->text('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('site_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('village_potentials');
        Schema::dropIfExists('msmes');
        Schema::dropIfExists('map_points');
        Schema::dropIfExists('infographics');
        Schema::dropIfExists('village_profiles');
    }
};
