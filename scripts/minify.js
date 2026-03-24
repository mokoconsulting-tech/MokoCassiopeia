#!/usr/bin/env node
/* Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 *
 * This file is part of a Moko Consulting project.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 *
 * # FILE INFORMATION
 * DEFGROUP: Joomla.Template.Site
 * INGROUP: MokoCassiopeia
 * REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 * PATH: ./scripts/minify.js
 * VERSION: 03.09.01
 * BRIEF: Generates .min.css and .min.js files from the Joomla asset manifest
 */

'use strict';

const fs   = require('fs');
const path = require('path');

const CleanCSS = require('clean-css');
const { minify: terserMinify } = require('terser');

// ---------------------------------------------------------------------------
// Config
// ---------------------------------------------------------------------------

const ROOT        = path.resolve(__dirname, '..');
const SRC_MEDIA   = path.join(ROOT, 'src', 'media');
const ASSET_JSON  = path.join(ROOT, 'src', 'joomla.asset.json');

// URI prefix used in the manifest — maps to SRC_MEDIA on disk.
// e.g. "media/templates/site/mokocassiopeia/css/template.css"
const URI_PREFIX = 'media/templates/site/mokocassiopeia/';

// ---------------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------------

/**
 * Resolve a manifest URI to an absolute disk path under src/media/.
 *
 * @param {string} uri  e.g. "media/templates/site/mokocassiopeia/css/foo.css"
 * @returns {string|null}
 */
function uriToPath(uri) {
	if (!uri.startsWith(URI_PREFIX)) return null;
	return path.join(SRC_MEDIA, uri.slice(URI_PREFIX.length));
}

/**
 * Return true if the filename looks like an already-minified file or belongs
 * to a vendor bundle we don't own.
 */
function isVendorOrUserFile(filePath) {
	const rel = filePath.replace(SRC_MEDIA + path.sep, '');
	return rel.startsWith('vendor' + path.sep)
		|| path.basename(filePath).startsWith('user.');
}

// ---------------------------------------------------------------------------
// Pair detection
// ---------------------------------------------------------------------------

/**
 * Read the asset manifest and return an array of { src, dest, type } pairs
 * where dest is a minified version of src that doesn't already exist or is
 * older than src.
 *
 * Pairing logic: for every non-.min asset, check whether the manifest also
 * contains a corresponding .min asset. If so, that's our pair.
 */
function detectPairs(assets) {
	// Build a lookup of all URIs in the manifest.
	const uriSet = new Set(assets.map(a => a.uri));

	const pairs = [];

	for (const asset of assets) {
		const { uri, type } = asset;
		if (type !== 'style' && type !== 'script') continue;

		// Skip already-minified entries.
		if (/\.min\.(css|js)$/.test(uri)) continue;

		// Derive the expected .min URI.
		const minUri = uri.replace(/\.(css|js)$/, '.min.$1');
		if (!uriSet.has(minUri)) continue;

		const srcPath  = uriToPath(uri);
		const destPath = uriToPath(minUri);
		if (!srcPath || !destPath) continue;

		if (isVendorOrUserFile(srcPath)) continue;

		if (!fs.existsSync(srcPath)) {
			console.warn(`  [skip]  source missing: ${srcPath}`);
			continue;
		}

		pairs.push({ src: srcPath, dest: destPath, type });
	}

	return pairs;
}

// ---------------------------------------------------------------------------
// Minifiers
// ---------------------------------------------------------------------------

async function minifyCSS(srcPath, destPath) {
	const source  = fs.readFileSync(srcPath, 'utf8');
	const result  = new CleanCSS({ level: 2, returnPromise: true });
	const output  = await result.minify(source);

	if (output.errors && output.errors.length) {
		throw new Error(output.errors.join('\n'));
	}

	fs.mkdirSync(path.dirname(destPath), { recursive: true });
	fs.writeFileSync(destPath, output.styles, 'utf8');

	const srcSize  = Buffer.byteLength(source,         'utf8');
	const destSize = Buffer.byteLength(output.styles,  'utf8');
	const saving   = (100 - (destSize / srcSize * 100)).toFixed(1);

	return { srcSize, destSize, saving };
}

async function minifyJS(srcPath, destPath) {
	const source = fs.readFileSync(srcPath, 'utf8');
	const result = await terserMinify(source, {
		compress: { drop_console: false },
		mangle:   true,
		format:   { comments: false }
	});

	if (!result.code) throw new Error('terser returned no output');

	fs.mkdirSync(path.dirname(destPath), { recursive: true });
	fs.writeFileSync(destPath, result.code, 'utf8');

	const srcSize  = Buffer.byteLength(source,      'utf8');
	const destSize = Buffer.byteLength(result.code, 'utf8');
	const saving   = (100 - (destSize / srcSize * 100)).toFixed(1);

	return { srcSize, destSize, saving };
}

// ---------------------------------------------------------------------------
// Main
// ---------------------------------------------------------------------------

(async () => {
	const manifest = JSON.parse(fs.readFileSync(ASSET_JSON, 'utf8'));
	const pairs    = detectPairs(manifest.assets);

	if (pairs.length === 0) {
		console.log('No pairs found — nothing to minify.');
		return;
	}

	console.log(`\nMinifying ${pairs.length} file(s)...\n`);

	let ok = 0, fail = 0;

	for (const { src, dest, type } of pairs) {
		const label = path.relative(ROOT, src);
		process.stdout.write(`  ${label} ... `);

		try {
			const stats = type === 'style'
				? await minifyCSS(src, dest)
				: await minifyJS(src, dest);

			const kb = n => (n / 1024).toFixed(1) + ' kB';
			console.log(`${kb(stats.srcSize)} → ${kb(stats.destSize)}  (${stats.saving}% saved)`);
			ok++;
		} catch (err) {
			console.error(`FAILED\n    ${err.message}`);
			fail++;
		}
	}

	console.log(`\nDone. ${ok} succeeded, ${fail} failed.\n`);
	if (fail > 0) process.exit(1);
})();
