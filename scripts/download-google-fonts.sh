#!/bin/bash
# Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
# SPDX-License-Identifier: GPL-3.0-or-later
#
# Download Google Fonts for self-hosting
# This script downloads Roboto, Noto Sans, and Fira Sans fonts

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Target directory
FONTS_DIR="../src/media/fonts"

echo -e "${BLUE}╔════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║  Google Fonts Downloader for MokoCassiopeia  ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════╝${NC}"
echo ""

# Check if fonts directory exists
if [ ! -d "$FONTS_DIR" ]; then
	echo -e "${RED}✗ Error: Fonts directory not found: $FONTS_DIR${NC}"
	exit 1
fi

cd "$FONTS_DIR"

echo -e "${YELLOW}Target directory: $(pwd)${NC}"
echo ""

# Function to download font CSS and extract font files
download_font() {
	local font_name="$1"
	local font_url="$2"
	local display_name="$3"
	
	echo -e "${GREEN}Downloading $display_name...${NC}"
	
	# Download CSS with user agent for woff2 format
	css=$(curl -s -A "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" "$font_url")
	
	if [ -z "$css" ]; then
		echo -e "${RED}  ✗ Failed to download CSS${NC}"
		return 1
	fi
	
	# Extract woff2 URLs
	urls=$(echo "$css" | grep -oP 'https://fonts\.gstatic\.com[^\)]*\.woff2' || true)
	
	if [ -z "$urls" ]; then
		echo -e "${RED}  ✗ No font URLs found in CSS${NC}"
		return 1
	fi
	
	count=0
	while IFS= read -r url; do
		if [ -z "$url" ]; then
			continue
		fi
		
		filename=$(basename "$url")
		echo -e "  → Downloading ${filename}..."
		
		if curl -s "$url" -o "$filename"; then
			size=$(du -h "$filename" | cut -f1)
			echo -e "${GREEN}    ✓ Downloaded ($size)${NC}"
			((count++))
		else
			echo -e "${RED}    ✗ Failed${NC}"
		fi
	done <<< "$urls"
	
	echo -e "${GREEN}  ✓ Downloaded $count font files${NC}"
	echo ""
}

# Download fonts
download_font "roboto" "https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" "Roboto"
download_font "noto-sans" "https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;300;400;700&display=swap" "Noto Sans"
download_font "fira-sans" "https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;300;400;700&display=swap" "Fira Sans"

echo -e "${GREEN}╔════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  ✓ All fonts downloaded successfully!    ║${NC}"
echo -e "${GREEN}╚════════════════════════════════════════════╝${NC}"
echo ""
echo -e "Font files saved to: ${BLUE}$(pwd)${NC}"
echo ""
echo "Next steps:"
echo "1. Verify font files are present"
echo "2. Update templateDetails.xml font options (if needed)"
echo "3. Remove Google Fonts CDN preconnect links from PHP templates"
