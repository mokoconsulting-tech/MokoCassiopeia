<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * CSS/JS minifier — generates .min files from source when dev mode is off,
 * deletes them when dev mode is on.
 */

defined('_JEXEC') or die;

class MokoMinifyHelper
{
    /**
     * Files to minify: source path relative to template media root.
     * The .min variant is derived automatically (template.css → template.min.css).
     */
    private const CSS_FILES = [
        'css/template.css',
        'css/theme/light.standard.css',
        'css/theme/dark.standard.css',
        'css/theme/light.custom.css',
        'css/theme/dark.custom.css',
    ];

    private const JS_FILES = [
        'js/template.js',
    ];

    /**
     * When dev mode is ON: delete all .min files.
     * When dev mode is OFF: regenerate .min files if source is newer.
     *
     * @param  string  $mediaRoot  Absolute path to the template media directory.
     * @param  bool    $devMode    Whether development mode is enabled.
     */
    public static function sync(string $mediaRoot, bool $devMode): void
    {
        $mediaRoot = rtrim($mediaRoot, '/\\');

        foreach (self::CSS_FILES as $relPath) {
            $source = $mediaRoot . '/' . $relPath;
            $min    = self::minPath($source);

            if ($devMode) {
                self::deleteIfExists($min);
            } else {
                self::buildIfStale($source, $min, 'css');
            }
        }

        foreach (self::JS_FILES as $relPath) {
            $source = $mediaRoot . '/' . $relPath;
            $min    = self::minPath($source);

            if ($devMode) {
                self::deleteIfExists($min);
            } else {
                self::buildIfStale($source, $min, 'js');
            }
        }
    }

    /**
     * Derive the .min path from a source path.
     * template.css → template.min.css
     */
    private static function minPath(string $path): string
    {
        $info = pathinfo($path);
        return $info['dirname'] . '/' . $info['filename'] . '.min.' . $info['extension'];
    }

    /**
     * Delete a file if it exists.
     */
    private static function deleteIfExists(string $path): void
    {
        if (is_file($path)) {
            @unlink($path);
        }
    }

    /**
     * Build the minified file if the source is newer or the min file is missing.
     */
    private static function buildIfStale(string $source, string $min, string $type): void
    {
        if (!is_file($source)) {
            return;
        }

        // Skip if min file exists and is newer than source
        if (is_file($min) && filemtime($min) >= filemtime($source)) {
            return;
        }

        $content = file_get_contents($source);
        if ($content === false) {
            return;
        }

        $minified = ($type === 'css')
            ? self::minifyCss($content)
            : self::minifyJs($content);

        file_put_contents($min, $minified);
    }

    /**
     * Minify CSS by stripping comments, excess whitespace, and unnecessary characters.
     */
    private static function minifyCss(string $css): string
    {
        // Remove comments (but keep IE hacks like /*\*/)
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

        // Remove whitespace around { } : ; , > + ~
        $css = preg_replace('/\s*([{}:;,>+~])\s*/', '$1', $css);

        // Remove remaining newlines and tabs
        $css = preg_replace('/\s+/', ' ', $css);

        // Remove spaces around selectors
        $css = str_replace(['{ ', ' {', '; ', ' ;'], ['{', '{', ';', ';'], $css);

        // Remove trailing semicolons before closing braces
        $css = str_replace(';}', '}', $css);

        // Remove leading/trailing whitespace
        return trim($css);
    }

    /**
     * Minify JS by stripping single-line comments, multi-line comments,
     * and collapsing whitespace. Preserves string literals.
     */
    private static function minifyJs(string $js): string
    {
        // Remove multi-line comments
        $js = preg_replace('!/\*.*?\*/!s', '', $js);

        // Remove single-line comments (but not URLs like http://)
        $js = preg_replace('!(?<=^|[\s;{}()\[\]])//[^\n]*!m', '', $js);

        // Collapse whitespace
        $js = preg_replace('/\s+/', ' ', $js);

        // Remove spaces around operators and punctuation
        $js = preg_replace('/\s*([{}();,=+\-*\/<>!&|?:])\s*/', '$1', $js);

        // Restore necessary spaces (after keywords)
        $js = preg_replace('/(var|let|const|return|typeof|instanceof|new|delete|throw|case|in|of)([^\s;})><=!&|?:,])/', '$1 $2', $js);

        return trim($js);
    }
}
