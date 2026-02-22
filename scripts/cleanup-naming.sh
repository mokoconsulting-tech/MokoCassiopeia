#!/bin/bash

################################################################################
# MokoCassiopeia Naming Cleanup Script
################################################################################
#
# DESCRIPTION:
#   This script renames all instances of "Moko-Cassiopeia" (hyphenated) to
#   "MokoCassiopeia" (camelCase) throughout the repository to ensure consistent
#   naming conventions.
#
# USAGE:
#   ./scripts/cleanup-naming.sh [OPTIONS]
#
# OPTIONS:
#   --dry-run         Preview changes without making them (default)
#   --execute         Actually perform the renaming
#   --backup          Create backup files before modification (.bak extension)
#   --help            Show this help message
#
# EXAMPLES:
#   # Preview changes
#   ./scripts/cleanup-naming.sh --dry-run
#
#   # Execute changes with backup
#   ./scripts/cleanup-naming.sh --execute --backup
#
#   # Execute changes without backup
#   ./scripts/cleanup-naming.sh --execute
#
# AUTHOR: MokoConsulting Tech Team
# DATE: 2026-02-22
# VERSION: 1.0.0
#
################################################################################

set -e  # Exit on error

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Default options
DRY_RUN=true
CREATE_BACKUP=false
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"

# Statistics
TOTAL_FILES_SCANNED=0
TOTAL_FILES_MODIFIED=0
TOTAL_REPLACEMENTS=0

################################################################################
# Functions
################################################################################

show_help() {
    sed -n '/^# DESCRIPTION:/,/^################################################################################$/p' "$0" | sed 's/^# //; s/^#//'
    exit 0
}

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

print_banner() {
    echo ""
    echo "╔════════════════════════════════════════════════════════════════╗"
    echo "║     MokoCassiopeia Naming Cleanup Script v1.0.0               ║"
    echo "║     Moko-Cassiopeia → MokoCassiopeia                          ║"
    echo "╚════════════════════════════════════════════════════════════════╝"
    echo ""
}

print_summary() {
    echo ""
    echo "╔════════════════════════════════════════════════════════════════╗"
    echo "║                        Summary                                 ║"
    echo "╠════════════════════════════════════════════════════════════════╣"
    printf "║  %-20s %-40s ║\n" "Files Scanned:" "$TOTAL_FILES_SCANNED"
    printf "║  %-20s %-40s ║\n" "Files Modified:" "$TOTAL_FILES_MODIFIED"
    printf "║  %-20s %-40s ║\n" "Replacements:" "$TOTAL_REPLACEMENTS"
    echo "╚════════════════════════════════════════════════════════════════╝"
    echo ""
}

# Process a single file
process_file() {
    local file="$1"
    local relative_path="${file#$REPO_ROOT/}"
    
    # Skip .git directory and node_modules
    if [[ "$file" == *".git/"* ]] || [[ "$file" == *"node_modules/"* ]]; then
        return 0
    fi
    
    # Skip the cleanup script itself
    if [[ "$file" == *"cleanup-naming.sh" ]]; then
        return 0
    fi
    
    TOTAL_FILES_SCANNED=$((TOTAL_FILES_SCANNED + 1))
    
    # Check if file contains any of our search patterns
    local has_changes=false
    local count=0
    
    # Count occurrences
    count=$(grep -c "Moko-Cassiopeia\|moko-cassiopeia" "$file" 2>/dev/null || true)
    
    if [ "$count" -gt 0 ]; then
        has_changes=true
        TOTAL_REPLACEMENTS=$((TOTAL_REPLACEMENTS + count))
        
        if [ "$DRY_RUN" = true ]; then
            log_info "Would modify: $relative_path ($count occurrences)"
            
            # Show the lines that would be changed
            grep -n "Moko-Cassiopeia\|moko-cassiopeia" "$file" | head -5 | while read -r line; do
                echo "    $line"
            done
            
            if [ "$count" -gt 5 ]; then
                echo "    ... and $((count - 5)) more"
            fi
        else
            log_info "Modifying: $relative_path ($count occurrences)"
            
            # Create backup if requested
            if [ "$CREATE_BACKUP" = true ]; then
                cp "$file" "$file.bak"
                log_info "  Created backup: $file.bak"
            fi
            
            # Perform replacements
            # Use sed with backup to ensure atomic operation
            sed -i.tmp 's/Moko-Cassiopeia/MokoCassiopeia/g; s/moko-cassiopeia/mokocassiopeia/g' "$file"
            rm -f "$file.tmp"
            
            log_success "  Modified successfully"
        fi
        
        TOTAL_FILES_MODIFIED=$((TOTAL_FILES_MODIFIED + 1))
    fi
}

# Main processing function
process_files() {
    log_info "Scanning repository: $REPO_ROOT"
    echo ""
    
    # File patterns to search
    local patterns=(
        "*.md"
        "*.php"
        "*.xml"
        "*.ini"
        "*.txt"
        "*.json"
        "*.yml"
        "*.yaml"
        "*.sh"
        "*.js"
        "*.css"
    )
    
    # Build find command with all patterns
    local find_cmd="find \"$REPO_ROOT\" -type f \\( "
    local first=true
    for pattern in "${patterns[@]}"; do
        if [ "$first" = true ]; then
            find_cmd+="-name \"$pattern\""
            first=false
        else
            find_cmd+=" -o -name \"$pattern\""
        fi
    done
    find_cmd+=" \\)"
    
    # Execute find and process each file
    # Use process substitution to avoid subshell
    while IFS= read -r file; do
        process_file "$file"
    done < <(eval "$find_cmd")
    
    echo ""
}

################################################################################
# Main Script
################################################################################

# Parse command line arguments
while [[ $# -gt 0 ]]; do
    case $1 in
        --dry-run)
            DRY_RUN=true
            shift
            ;;
        --execute)
            DRY_RUN=false
            shift
            ;;
        --backup)
            CREATE_BACKUP=true
            shift
            ;;
        --help|-h)
            show_help
            ;;
        *)
            log_error "Unknown option: $1"
            echo "Use --help for usage information"
            exit 1
            ;;
    esac
done

# Print banner
print_banner

# Show mode
if [ "$DRY_RUN" = true ]; then
    log_warning "Running in DRY-RUN mode (no changes will be made)"
    log_info "Use --execute to actually perform changes"
else
    log_warning "Running in EXECUTE mode (changes will be made)"
    if [ "$CREATE_BACKUP" = true ]; then
        log_info "Backup files will be created (.bak extension)"
    else
        log_warning "No backups will be created"
    fi
    
    # Confirmation prompt
    echo ""
    read -p "Are you sure you want to proceed? (yes/no): " -r
    echo ""
    if [[ ! $REPLY =~ ^[Yy][Ee][Ss]$ ]]; then
        log_warning "Operation cancelled by user"
        exit 0
    fi
fi

echo ""

# Change to repo root
cd "$REPO_ROOT"

# Check if git repository
if [ ! -d ".git" ]; then
    log_error "Not a git repository. Please run from repository root."
    exit 1
fi

# Check for uncommitted changes
if ! git diff-index --quiet HEAD -- 2>/dev/null; then
    log_warning "You have uncommitted changes in your repository"
    if [ "$DRY_RUN" = false ]; then
        read -p "Continue anyway? (yes/no): " -r
        echo ""
        if [[ ! $REPLY =~ ^[Yy][Ee][Ss]$ ]]; then
            log_warning "Operation cancelled by user"
            exit 0
        fi
    fi
fi

# Process files
process_files

# Print summary
print_summary

# Final message
if [ "$DRY_RUN" = true ]; then
    echo ""
    log_info "This was a dry run. No files were modified."
    log_info "To execute changes, run: $0 --execute"
    echo ""
else
    echo ""
    log_success "Cleanup completed successfully!"
    log_info "Total files modified: $TOTAL_FILES_MODIFIED"
    log_info "Total replacements made: $TOTAL_REPLACEMENTS"
    
    if [ "$CREATE_BACKUP" = true ]; then
        echo ""
        log_info "Backup files (.bak) have been created."
        log_info "To remove backups, run: find . -name '*.bak' -delete"
    fi
    
    echo ""
    log_warning "Don't forget to:"
    echo "  1. Review the changes with: git diff"
    echo "  2. Test the modified files"
    echo "  3. Commit the changes: git add . && git commit -m 'Clean up naming: Moko-Cassiopeia → MokoCassiopeia'"
    echo ""
fi

exit 0
