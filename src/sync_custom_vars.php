<?php
/**
 * Copyright (C) 2025 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 */

/**
 * CSS Variable Sync Utility
 * Compares a user's custom palette file against the template starter file and
 * injects any missing CSS variable declarations.  Existing user values are
 * never overwritten — only genuinely new variables are added.
 * Usage (CLI):
 * php sync_custom_vars.php
 * Usage (from Joomla script.php or plugin):
 * require_once __DIR__ . '/sync_custom_vars.php';
 * MokoCssVarSync::run();
 * The script auto-detects Joomla's root by walking up from __DIR__.
 */

defined('_JEXEC') or define('MOKO_CLI', true);

final class MokoCssVarSync
{
    /**
     * Template name used in Joomla's media path.
     */
    private const TPL = 'mokocassiopeia';

    /**
     * Palette pairs: [starter template path relative to this file, user file relative to Joomla root].
     */
    private const PALETTES = [
        [
            'starter' => 'templates/light.custom.css',
            'user'    => 'media/templates/site/%s/css/theme/light.custom.css',
        ],
        [
            'starter' => 'templates/dark.custom.css',
            'user'    => 'media/templates/site/%s/css/theme/dark.custom.css',
        ],
    ];

    /**
     * Run the sync for all palette pairs.
     *
     * @param  string|null  $joomlaRoot  Absolute path to Joomla root (auto-detected if null).
     * @return array<string, array{added: string[], skipped: string[]}>  Results keyed by file path.
     */
    public static function run(?string $joomlaRoot = null): array
    {
        $tplDir = self::resolveTemplateDir();
        $root   = $joomlaRoot ?? self::detectJoomlaRoot();

        $results = [];

        foreach (self::PALETTES as $pair) {
            $starterPath = $tplDir . '/' . $pair['starter'];
            $userPath    = $root . '/' . sprintf($pair['user'], self::TPL);

            if (!is_file($starterPath)) {
                self::log("SKIP  starter not found: {$starterPath}");
                continue;
            }

            if (!is_file($userPath)) {
                self::log("SKIP  user file not found (custom palette not deployed): {$userPath}");
                continue;
            }

            $result = self::syncFile($starterPath, $userPath);
            $results[$userPath] = $result;

            $addedCount = count($result['added']);
            if ($addedCount > 0) {
                self::log("ADDED {$addedCount} variable(s) to {$userPath}");
                foreach ($result['added'] as $var) {
                    self::log("  + {$var}");
                }
            } else {
                self::log("OK    {$userPath} — all variables present");
            }
        }

        return $results;
    }

    /**
     * Compare a starter file against a user file and inject missing variables.
     *
     * @param  string  $starterPath  Absolute path to the starter template CSS.
     * @param  string  $userPath     Absolute path to the user's custom CSS.
     * @return array{added: string[], skipped: string[]}
     */
    private static function syncFile(string $starterPath, string $userPath): array
    {
        $starterVars = self::extractVarsWithContext($starterPath);
        $userVars    = self::extractVarNames($userPath);

        $missing = [];
        foreach ($starterVars as $name => $declaration) {
            if (!isset($userVars[$name])) {
                $missing[$name] = $declaration;
            }
        }

        if (empty($missing)) {
            return ['added' => [], 'skipped' => []];
        }

        // Group missing variables by their section comment header.
        $sections = self::groupBySection($missing, $starterPath);

        // Build the injection block.
        $injection = self::buildInjectionBlock($sections);

        // Insert before the closing } of the :root rule.
        $userCss = file_get_contents($userPath);
        $userCss = self::injectBeforeRootClose($userCss, $injection);

        // Write back (atomic: write to .tmp then rename).
        $tmpPath = $userPath . '.tmp';
        file_put_contents($tmpPath, $userCss);
        rename($tmpPath, $userPath);

        return ['added' => array_keys($missing), 'skipped' => []];
    }

    /**
     * Extract CSS custom property declarations with their full text (name: value).
     * Only extracts from the first :root block.
     *
     * @return array<string, string>  Variable name => full declaration line.
     */
    private static function extractVarsWithContext(string $filePath): array
    {
        $css  = file_get_contents($filePath);
        $vars = [];

        // Match --variable-name: value (possibly spanning multiple lines until ;)
        if (preg_match_all('/^\s*(--[\w-]+)\s*:\s*([^;]+);/m', $css, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $m) {
                $name  = trim($m[1]);
                $value = trim($m[2]);
                $vars[$name] = "{$name}: {$value};";
            }
        }

        return $vars;
    }

    /**
     * Extract just the variable names present in a CSS file.
     *
     * @return array<string, true>
     */
    private static function extractVarNames(string $filePath): array
    {
        $css  = file_get_contents($filePath);
        $vars = [];

        if (preg_match_all('/^\s*(--[\w-]+)\s*:/m', $css, $matches)) {
            foreach ($matches[1] as $name) {
                $vars[trim($name)] = true;
            }
        }

        return $vars;
    }

    /**
     * Group missing variables by the section comment they appear under in the starter file.
     *
     * @param  array<string, string>  $missing       Variable name => declaration.
     * @param  string                 $starterPath   Path to starter file.
     * @return array<string, string[]>  Section header => list of declarations.
     */
    private static function groupBySection(array $missing, string $starterPath): array
    {
        $lines   = file($starterPath, FILE_IGNORE_NEW_LINES);
        $section = 'Uncategorised';
        $map     = [];  // variable name => section

        foreach ($lines as $line) {
            // Detect section comment headers like /* ===== HERO VARIANTS ===== */
            if (preg_match('/\/\*\s*=+\s*(.+?)\s*=+\s*\*\//', $line, $m)) {
                $section = trim($m[1]);
            }
            // Detect variable declaration
            if (preg_match('/^\s*(--[\w-]+)\s*:/', $line, $m)) {
                $name = trim($m[1]);
                if (isset($missing[$name])) {
                    $map[$name] = $section;
                }
            }
        }

        // Group by section
        $sections = [];
        foreach ($missing as $name => $declaration) {
            $sec = $map[$name] ?? 'Uncategorised';
            $sections[$sec][] = $declaration;
        }

        return $sections;
    }

    /**
     * Build a CSS block from grouped sections ready for injection.
     */
    private static function buildInjectionBlock(array $sections): string
    {
        $lines = [];
        $lines[] = '';
        $lines[] = '/* ===== VARIABLES ADDED BY SYNC (' . date('Y-m-d') . ') ===== */';

        foreach ($sections as $sectionName => $declarations) {
            $lines[] = '';
            $lines[] = "/* -- {$sectionName} -- */";
            foreach ($declarations as $decl) {
                $lines[] = $decl;
            }
        }

        $lines[] = '';

        return implode("\n", $lines);
    }

    /**
     * Inject a block of CSS just before the closing } of the :root[data-bs-theme] rule.
     */
    private static function injectBeforeRootClose(string $css, string $block): string
    {
        // Find the :root block's closing brace. The :root rule is the first major
        // rule in the file; its closing } is on its own line.
        // Strategy: find the LAST } that is preceded only by CSS variable content.
        // More robustly: find the first } that appears on its own line (possibly
        // with whitespace), which closes the :root block.

        // Walk backwards from each } to see if it's inside the :root block.
        // Simple approach: the :root closing } is the first bare } on its own line.
        $pos = self::findRootClosingBrace($css);

        if ($pos === false) {
            // Fallback: append before last }
            $pos = strrpos($css, '}');
        }

        if ($pos === false) {
            // Last resort: append to end
            return $css . $block;
        }

        return substr($css, 0, $pos) . $block . substr($css, $pos);
    }

    /**
     * Find the byte position of the closing } for the :root rule.
     */
    private static function findRootClosingBrace(string $css): int|false
    {
        // Find where :root starts
        $rootStart = preg_match('/:root\b/', $css, $m, PREG_OFFSET_CAPTURE);
        if (!$rootStart) {
            return false;
        }

        $offset = $m[0][1];
        $depth  = 0;
        $len    = strlen($css);

        for ($i = $offset; $i < $len; $i++) {
            if ($css[$i] === '{') {
                $depth++;
            } elseif ($css[$i] === '}') {
                $depth--;
                if ($depth === 0) {
                    return $i;
                }
            }
        }

        return false;
    }

    /**
     * Resolve the template source directory (where this file lives).
     */
    private static function resolveTemplateDir(): string
    {
        return dirname(__FILE__);
    }

    /**
     * Auto-detect Joomla root by walking up from template dir looking for
     * configuration.php or the media/templates directory structure.
     */
    private static function detectJoomlaRoot(): string
    {
        $dir = dirname(__FILE__);

        // Walk up max 10 levels
        for ($i = 0; $i < 10; $i++) {
            if (is_file($dir . '/configuration.php')) {
                return $dir;
            }
            // Also check for the media/templates structure (works in dev too)
            if (is_dir($dir . '/media/templates')) {
                return $dir;
            }
            $parent = dirname($dir);
            if ($parent === $dir) {
                break;
            }
            $dir = $parent;
        }

        // Fallback for dev: if JPATH_ROOT is defined, use it
        if (defined('JPATH_ROOT')) {
            return JPATH_ROOT;
        }

        self::log('WARNING: Could not auto-detect Joomla root. Pass it explicitly.');
        return dirname(__FILE__);
    }

    /**
     * Log a message (CLI: stdout, web: Joomla enqueueMessage if available).
     */
    private static function log(string $message): void
    {
        if (defined('MOKO_CLI') || PHP_SAPI === 'cli') {
            echo $message . PHP_EOL;
        }
    }

    /**
     * Dry-run mode: report what would be added without writing.
     *
     * @return array<string, string[]>  File path => list of missing variable names.
     */
    public static function dryRun(?string $joomlaRoot = null): array
    {
        $tplDir = self::resolveTemplateDir();
        $root   = $joomlaRoot ?? self::detectJoomlaRoot();
        $report = [];

        foreach (self::PALETTES as $pair) {
            $starterPath = $tplDir . '/' . $pair['starter'];
            $userPath    = $root . '/' . sprintf($pair['user'], self::TPL);

            if (!is_file($starterPath) || !is_file($userPath)) {
                continue;
            }

            $starterVars = self::extractVarsWithContext($starterPath);
            $userVars    = self::extractVarNames($userPath);

            $missing = [];
            foreach ($starterVars as $name => $declaration) {
                if (!isset($userVars[$name])) {
                    $missing[] = $name;
                }
            }

            if (!empty($missing)) {
                $report[$userPath] = $missing;
            }
        }

        return $report;
    }
}

// CLI entry point
if (PHP_SAPI === 'cli' && realpath($argv[0] ?? '') === realpath(__FILE__)) {
    $dryRun = in_array('--dry-run', $argv, true);

    echo "MokoCassiopeia CSS Variable Sync\n";
    echo str_repeat('─', 40) . "\n\n";

    if ($dryRun) {
        echo "DRY RUN — no files will be modified\n\n";
        $report = MokoCssVarSync::dryRun();
        if (empty($report)) {
            echo "All custom palettes are up to date.\n";
        } else {
            foreach ($report as $file => $vars) {
                echo "MISSING in {$file}:\n";
                foreach ($vars as $var) {
                    echo "  - {$var}\n";
                }
                echo "\n";
            }
        }
    } else {
        MokoCssVarSync::run();
    }

    echo "\nDone.\n";
}
