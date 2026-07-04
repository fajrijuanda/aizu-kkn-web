<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use InvalidArgumentException;

class Base64ImageService
{
    /**
     * @return array{src: string, mime_type: string, alt: string|null, original_name: string}
     */
    public function encode(UploadedFile $file, ?string $alt = null): array
    {
        $mimeType = $file->getMimeType() ?: '';
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if (! in_array($mimeType, $allowed, true)) {
            throw new InvalidArgumentException('Format gambar harus JPG, PNG, atau WEBP.');
        }

        $contents = file_get_contents($file->getRealPath());

        if ($contents === false) {
            throw new InvalidArgumentException('Gambar gagal dibaca.');
        }

        return [
            'src' => sprintf('data:%s;base64,%s', $mimeType, base64_encode($contents)),
            'mime_type' => $mimeType,
            'alt' => $alt ?: Str::headline(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)),
            'original_name' => $file->getClientOriginalName(),
        ];
    }
}
