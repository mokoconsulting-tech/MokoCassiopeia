<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * Favicon generator — creates ICO, Apple Touch Icon, and Android icons
 * from a single source PNG uploaded via the template config.
 */

defined('_JEXEC') or die;

class MokoFaviconHelper
{
    /**
     * Sizes to generate: filename => [width, height, format].
     * ICO embeds 16×16 and 32×32 internally.
     */
    private const SIZES = [
        'apple-touch-icon.png' => [180, 180, 'png'],
        'favicon-32x32.png'    => [32, 32, 'png'],
        'favicon-16x16.png'    => [16, 16, 'png'],
        'android-chrome-192x192.png' => [192, 192, 'png'],
        'android-chrome-512x512.png' => [512, 512, 'png'],
    ];

    /**
     * Generate all favicon files from a source PNG if they don't already exist
     * or if the source has been modified since last generation.
     *
     * @param  string  $sourcePath  Absolute path to the source PNG.
     * @param  string  $outputDir   Absolute path to the output directory.
     *
     * @return bool  True if generation succeeded or files are up to date.
     */
    public static function generate(string $sourcePath, string $outputDir): bool
    {
        if (!is_file($sourcePath) || !extension_loaded('gd')) {
            return false;
        }

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $sourceTime = filemtime($sourcePath);
        $stampFile  = $outputDir . '/.favicon_generated';

        // Skip if already up to date
        if (is_file($stampFile) && filemtime($stampFile) >= $sourceTime) {
            return true;
        }

        $source = imagecreatefrompng($sourcePath);
        if (!$source) {
            return false;
        }

        imagealphablending($source, false);
        imagesavealpha($source, true);

        $srcW = imagesx($source);
        $srcH = imagesy($source);

        // Generate PNG sizes
        foreach (self::SIZES as $filename => [$w, $h]) {
            $resized = imagecreatetruecolor($w, $h);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
            imagefill($resized, 0, 0, $transparent);

            imagecopyresampled($resized, $source, 0, 0, 0, 0, $w, $h, $srcW, $srcH);
            imagepng($resized, $outputDir . '/' . $filename, 9);
            imagedestroy($resized);
        }

        // Generate ICO (contains 16×16 and 32×32)
        self::generateIco($source, $srcW, $srcH, $outputDir . '/favicon.ico');

        // Generate site.webmanifest
        self::generateManifest($outputDir);

        imagedestroy($source);

        // Write timestamp stamp
        file_put_contents($stampFile, date('c'));

        return true;
    }

    /**
     * Build a minimal ICO file containing 16×16 and 32×32 PNG entries.
     */
    private static function generateIco(\GdImage $source, int $srcW, int $srcH, string $outPath): void
    {
        $entries = [];
        foreach ([16, 32] as $size) {
            $resized = imagecreatetruecolor($size, $size);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
            imagefill($resized, 0, 0, $transparent);
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $size, $size, $srcW, $srcH);

            ob_start();
            imagepng($resized, null, 9);
            $pngData = ob_get_clean();
            imagedestroy($resized);

            $entries[] = ['size' => $size, 'data' => $pngData];
        }

        // ICO header: 2 bytes reserved, 2 bytes type (1=ICO), 2 bytes count
        $count = count($entries);
        $ico = pack('vvv', 0, 1, $count);

        // Calculate offset: header (6) + directory entries (16 each)
        $offset = 6 + ($count * 16);
        $imageData = '';

        foreach ($entries as $entry) {
            $size = $entry['size'] >= 256 ? 0 : $entry['size'];
            $dataLen = strlen($entry['data']);

            // ICONDIRENTRY: width, height, colors, reserved, planes, bpp, size, offset
            $ico .= pack('CCCCvvVV', $size, $size, 0, 0, 1, 32, $dataLen, $offset);
            $imageData .= $entry['data'];
            $offset += $dataLen;
        }

        file_put_contents($outPath, $ico . $imageData);
    }

    /**
     * Write a site.webmanifest for Android/PWA icon discovery.
     */
    private static function generateManifest(string $outputDir): void
    {
        $manifest = [
            'icons' => [
                ['src' => 'android-chrome-192x192.png', 'sizes' => '192x192', 'type' => 'image/png'],
                ['src' => 'android-chrome-512x512.png', 'sizes' => '512x512', 'type' => 'image/png'],
            ],
        ];
        file_put_contents(
            $outputDir . '/site.webmanifest',
            json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }

    /**
     * Return the <link> tags to inject into <head>.
     *
     * @param  string  $basePath  URL path to the favicon directory (relative to site root).
     *
     * @return string  HTML link tags.
     */
    public static function getHeadTags(string $basePath): string
    {
        $basePath = rtrim($basePath, '/');

        return '<link rel="apple-touch-icon" sizes="180x180" href="' . $basePath . '/apple-touch-icon.png">' . "\n"
             . '<link rel="icon" type="image/png" sizes="32x32" href="' . $basePath . '/favicon-32x32.png">' . "\n"
             . '<link rel="icon" type="image/png" sizes="16x16" href="' . $basePath . '/favicon-16x16.png">' . "\n"
             . '<link rel="manifest" href="' . $basePath . '/site.webmanifest">' . "\n"
             . '<link rel="shortcut icon" href="' . $basePath . '/favicon.ico">' . "\n";
    }
}
