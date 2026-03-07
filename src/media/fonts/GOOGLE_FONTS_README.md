<!--
 Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
 
 SPDX-License-Identifier: GPL-3.0-or-later
 
 # FILE INFORMATION
 DEFGROUP: Joomla.Template.Site
 INGROUP: MokoCassiopeia.Documentation
 REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
 FILE: src/media/fonts/GOOGLE_FONTS_README.md
 VERSION: 03.08.04
 BRIEF: Instructions for downloading Google Fonts for self-hosting
-->

# Google Fonts - Download Instructions

This directory should contain self-hosted Google Font files to eliminate CDN dependencies.

## Required Font Files

Download the following `.woff2` font files and place them in this directory:

### Roboto Font Files
- `roboto-v30-latin-100.woff2` (Thin)
- `roboto-v30-latin-300.woff2` (Light)
- `roboto-v30-latin-regular.woff2` (Regular)
- `roboto-v30-latin-700.woff2` (Bold)

### Noto Sans Font Files
- `noto-sans-v36-latin-100.woff2` (Thin)
- `noto-sans-v36-latin-300.woff2` (Light)
- `noto-sans-v36-latin-regular.woff2` (Regular)
- `noto-sans-v36-latin-700.woff2` (Bold)

### Fira Sans Font Files
- `fira-sans-v17-latin-100.woff2` (Thin)
- `fira-sans-v17-latin-300.woff2` (Light)
- `fira-sans-v17-latin-regular.woff2` (Regular)
- `fira-sans-v17-latin-700.woff2` (Bold)

## How to Download

### Option 1: Using google-webfonts-helper (Recommended)

1. Visit https://gwfh.mranftl.com/
2. Search for each font (Roboto, Noto Sans, Fira Sans)
3. Select character sets: **latin** (or add latin-ext if needed)
4. Select styles:
   - ☑ 100 (thin)
   - ☑ 300 (light)
   - ☑ 400 (regular)
   - ☑ 700 (bold)
5. In step 3, ensure **Modern Browsers** is selected (woff2 format)
6. In step 4, click **Download files**
7. Extract the `.woff2` files to this directory

### Option 2: Using google-font-installer (Node.js)

```bash
npm install -g google-font-installer
cd src/media/fonts/

# Download Roboto
google-font-installer Roboto:100,300,400,700

# Download Noto Sans
google-font-installer "Noto Sans:100,300,400,700"

# Download Fira Sans
google-font-installer "Fira Sans:100,300,400,700"
```

### Option 3: Manual Download Script (Linux/macOS)

```bash
#!/bin/bash
# Run this from src/media/fonts/ directory

download_font() {
    local font_url="$1"
    local output_dir="."
    
    # Download CSS
    css=$(curl -s -A "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36" "$font_url")
    
    # Extract and download woff2 files
    echo "$css" | grep -oP 'https://fonts\.gstatic\.com[^\)]*\.woff2' | while read url; do
        filename=$(basename "$url")
        echo "Downloading $filename..."
        curl -s "$url" -o "$output_dir/$filename"
    done
}

download_font "https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap"
download_font "https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;300;400;700&display=swap"
download_font "https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;300;400;700&display=swap"
```

## Font CSS Files

The corresponding CSS files with `@font-face` declarations are located in:
- `../css/fonts/roboto.css`
- `../css/fonts/noto-sans.css`
- `../css/fonts/fira-sans.css`

These CSS files reference the `.woff2` files in this directory.

## License

All Google Fonts are open source and licensed under the SIL Open Font License (OFL).
- Roboto: Apache License 2.0
- Noto Sans: SIL Open Font License 1.1
- Fira Sans: SIL Open Font License 1.1

## References

- Google Fonts: https://fonts.google.com/
- google-webfonts-helper: https://gwfh.mranftl.com/
- Font Licensing: https://fonts.google.com/attribution
