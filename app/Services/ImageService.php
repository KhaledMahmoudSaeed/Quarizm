<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class ImageService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        // Initialize Cloudinary with config from .env
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true],
        ]);
    }
    public function uploadImage(UploadedFile $file): array
    {
        // Read image into memory
        $imageData = file_get_contents($file->getRealPath());

        // Use Intervention to compress and resize
        $image = Image::make($imageData);

        // Resize image (max 800x600)
        $image->resize(800, 600, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Compress quality to 75%
        $image->encode('jpg', 75);

        // Save compressed image to temporary path
        $tempPath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
        $image->save($tempPath);

        // Upload to Cloudinary
        $result = $this->cloudinary->uploadApi()->upload($tempPath, [
            'folder' => 'uploads',
            'resource_type' => 'image'
        ]);

        // Clean up temp file
        unlink($tempPath);

        if (isset($result['error'])) {
            throw new \Exception("Cloudinary upload error: " . $result['error']['message']);
        }

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id']
        ];
    }
    public function deleteImage(string $publicId): void
    {
        $result = $this->cloudinary->uploadApi()->destroy($publicId, [
            'resource_type' => 'image'
        ]);

        if ($result['result'] !== 'ok') {
            throw new \Exception("Failed to delete image: " . json_encode($result));
        }
    }
}