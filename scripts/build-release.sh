#!/usr/bin/env bash
# Copyright (C) 2026 Moko Consulting <hello@mokoconsulting.tech>
# SPDX-License-Identifier: GPL-3.0-or-later
# 
# FILE INFORMATION
# DEFGROUP: Build.Scripts
# INGROUP: MokoCassiopeia.Build
# REPO: https://github.com/mokoconsulting-tech/MokoCassiopeia
# PATH: /scripts/build-release.sh
# VERSION: 01.00.00
# BRIEF: Build release package for MokoCassiopeia template
# USAGE: ./scripts/build-release.sh [version]

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Script directory
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "${SCRIPT_DIR}/.." && pwd)"

# Functions
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if version is provided
if [ -z "$1" ]; then
    # Try to extract version from templateDetails.xml
    if [ -f "${PROJECT_ROOT}/src/templates/templateDetails.xml" ]; then
        VERSION=$(grep -oP '<version>\K[^<]+' "${PROJECT_ROOT}/src/templates/templateDetails.xml" | head -1)
        log_info "Detected version: ${VERSION}"
    else
        log_error "Please provide version as argument: ./build-release.sh 03.08.03"
        exit 1
    fi
else
    VERSION="$1"
fi

log_info "Building MokoCassiopeia release package"
log_info "Version: ${VERSION}"

# Change to project root
cd "${PROJECT_ROOT}"

# Create build directory
BUILD_DIR="${PROJECT_ROOT}/build"
PACKAGE_DIR="${BUILD_DIR}/package"
rm -rf "${BUILD_DIR}"
mkdir -p "${PACKAGE_DIR}"

log_info "Creating package structure..."

# Copy template files from src/templates
if [ -d "src/templates" ]; then
    rsync -av --exclude='.git*' src/templates/ "${PACKAGE_DIR}/"
else
    log_error "src/templates directory not found!"
    exit 1
fi

# Copy media files from src/media
if [ -d "src/media" ]; then
    mkdir -p "${PACKAGE_DIR}/media"
    rsync -av --exclude='.git*' src/media/ "${PACKAGE_DIR}/media/"
else
    log_warning "src/media directory not found, skipping media files"
fi

log_info "Package structure created"

# Create ZIP package
cd "${PACKAGE_DIR}"
ZIP_NAME="mokocassiopeia-src-${VERSION}.zip"
log_info "Creating ZIP package: ${ZIP_NAME}"

zip -r "../${ZIP_NAME}" . -q

if [ $? -ne 0 ]; then
    log_error "Failed to create ZIP package"
    exit 1
fi

cd "${BUILD_DIR}"
log_success "Created: ${ZIP_NAME}"

# Generate checksums
log_info "Generating checksums..."
sha256sum "${ZIP_NAME}" > "${ZIP_NAME}.sha256"
md5sum "${ZIP_NAME}" > "${ZIP_NAME}.md5"

# Extract just the hash
SHA256_HASH=$(sha256sum "${ZIP_NAME}" | cut -d' ' -f1)

log_success "SHA-256: ${SHA256_HASH}"
log_success "MD5: $(md5sum "${ZIP_NAME}" | cut -d' ' -f1)"

# Show file info
FILE_SIZE=$(du -h "${ZIP_NAME}" | cut -f1)
log_info "Package size: ${FILE_SIZE}"

# Summary
echo ""
log_success "Build completed successfully!"
echo ""
echo "Package: ${BUILD_DIR}/${ZIP_NAME}"
echo "SHA-256: ${BUILD_DIR}/${ZIP_NAME}.sha256"
echo "MD5:     ${BUILD_DIR}/${ZIP_NAME}.md5"
echo ""
echo "Next steps:"
echo "1. Test the package installation in Joomla"
echo "2. Create a GitHub release with this package"
echo "3. Update updates.xml with the new version and SHA-256 hash"
echo ""
