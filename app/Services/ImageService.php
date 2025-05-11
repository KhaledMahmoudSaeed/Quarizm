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
                'cloud_name' => config("app.cloudnairy.cloud_name"),
                'api_key' => config("app.cloudnairy.api_key"),
                'api_secret' => config("app.cloudnairy.api_secret"),
            ],
            'url' => ['secure' => true],
        ]);
    }
    public function uploadImage(UploadedFile $file): string
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

        return $result['secure_url'];

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
    public function extractPublicId(string $url): string
    {
        // Remove query string if present
        $url = strtok($url, '?');
        // Get the last segment after the last '/'
        $parts = explode('/', $url);
        $filename = end($parts);
        // Remove the extension
        $publicId = pathinfo($filename, PATHINFO_FILENAME);
        return $publicId;
    }
}