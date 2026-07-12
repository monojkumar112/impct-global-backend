<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageUploadService
{
    public const MAX_UPLOAD_KB = 10240;

    public function upload(UploadedFile $image, string $directory, int $maxWidth = 1920, int $quality = 80): string
    {
        $uploadDir = public_path($directory);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $baseName = time() . '_' . uniqid();
        $webpName = $baseName . '.webp';
        $webpPath = $uploadDir . DIRECTORY_SEPARATOR . $webpName;

        if (!function_exists('imagewebp')) {
            throw new \RuntimeException('GD WebP support is required for image uploads.');
        }

        $contents = file_get_contents($image->getRealPath());

        if ($contents === false) {
            throw new \RuntimeException('Could not read uploaded file.');
        }

        $img = @imagecreatefromstring($contents);

        if ($img === false) {
            throw new \RuntimeException('The uploaded image could not be processed.');
        }

        $img = $this->prepareImageResource($img, $image);
        $img = $this->resizeIfNeeded($img, $maxWidth);
        $result = @imagewebp($img, $webpPath, $quality);
        imagedestroy($img);

        if (!$result) {
            throw new \RuntimeException('The uploaded image could not be converted to WebP.');
        }

        return trim($directory, '/') . '/' . $webpName;
    }

    public function delete(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $fullPath = public_path($relativePath);

        if (file_exists($fullPath)) {
            @unlink($fullPath);
        }
    }

    protected function prepareImageResource($img, UploadedFile $image)
    {
        $ext = strtolower($image->getClientOriginalExtension() ?? '');

        if (!imageistruecolor($img)) {
            if (function_exists('imagepalettetotruecolor')) {
                @imagepalettetotruecolor($img);
            } else {
                $width = imagesx($img);
                $height = imagesy($img);
                $trueColor = imagecreatetruecolor($width, $height);

                if (in_array($ext, ['png', 'gif', 'webp'], true)) {
                    imagealphablending($trueColor, false);
                    imagesavealpha($trueColor, true);
                    $transparent = imagecolorallocatealpha($trueColor, 0, 0, 0, 127);
                    imagefilledrectangle($trueColor, 0, 0, $width, $height, $transparent);
                }

                imagecopyresampled($trueColor, $img, 0, 0, 0, 0, $width, $height, $width, $height);
                imagedestroy($img);

                return $trueColor;
            }
        }

        if (in_array($ext, ['png', 'webp'], true)) {
            imagealphablending($img, false);
            imagesavealpha($img, true);
        }

        return $img;
    }

    protected function resizeIfNeeded($img, int $maxWidth)
    {
        $width = imagesx($img);
        $height = imagesy($img);

        if ($width <= $maxWidth) {
            return $img;
        }

        $newWidth = $maxWidth;
        $newHeight = (int) round($height * ($newWidth / $width));
        $resized = imagecreatetruecolor($newWidth, $newHeight);

        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
        imagefilledrectangle($resized, 0, 0, $newWidth, $newHeight, $transparent);

        imagecopyresampled($resized, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($img);

        return $resized;
    }
}
