#!/usr/bin/env python3
"""
Extract custom tables from sql_dump.sql and import into dtehm_insurance_api database.
Skips wprm_* WordPress tables (contain spam content from hacked old project).
No table renaming needed - zero conflicts found.
"""

import re
import sys

DUMP_FILE = "sql_dump.sql"
OUTPUT_FILE = "import_custom_tables.sql"

# Only import these tables (the ones dtem-web PHP files actually use)
TABLES_TO_IMPORT = {
    'admin_activity_log',
    'admin_users',
    'causes',
    'contact_inquiries',
    'donations',
    'events',
    'gallery_albums',
    'gallery_images',
    'news_posts',
    'site_settings',
    'team_members',
}

def extract_tables():
    print(f"Reading {DUMP_FILE}...")
    
    with open(DUMP_FILE, 'r', encoding='utf-8', errors='replace') as f:
        content = f.read()
    
    print(f"File size: {len(content):,} characters")
    
    output_lines = []
    
    # Add header
    output_lines.append("-- Custom tables extracted from sql_dump.sql")
    output_lines.append("-- Imported into dtehm_insurance_api database")
    output_lines.append("-- WordPress (wprm_*) tables excluded")
    output_lines.append("")
    output_lines.append("SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';")
    output_lines.append("SET time_zone = '+00:00';")
    output_lines.append("SET NAMES utf8mb4;")
    output_lines.append("")
    
    # Split by the section separator pattern
    # phpMyAdmin dumps use: -- --------------------------------------------------------
    # followed by: -- Table structure for table `tablename`
    
    lines = content.split('\n')
    current_table = None
    capturing = False
    captured_count = 0
    skipped_count = 0
    tables_found = set()
    line_count = 0
    
    i = 0
    while i < len(lines):
        line = lines[i]
        
        # Detect table context from comments
        match = re.search(r'Table structure for table `(\w+)`', line)
        if match:
            table_name = match.group(1)
            if table_name in TABLES_TO_IMPORT:
                current_table = table_name
                capturing = True
                tables_found.add(table_name)
                output_lines.append("")
                output_lines.append(f"-- --------------------------------------------------------")
                output_lines.append(line)
                print(f"  Extracting: {table_name}")
                i += 1
                continue
            else:
                current_table = table_name
                capturing = False
                skipped_count += 1
                i += 1
                continue
        
        # Also detect data sections
        match = re.search(r'Dumping data for table `(\w+)`', line)
        if match:
            table_name = match.group(1)
            if table_name in TABLES_TO_IMPORT:
                current_table = table_name
                capturing = True
                output_lines.append("")
                output_lines.append(f"-- --------------------------------------------------------")
                output_lines.append(line)
                i += 1
                continue
            else:
                current_table = table_name
                capturing = False
                i += 1
                continue
        
        # Detect indexes section
        match = re.search(r'Indexes for table `(\w+)`', line)
        if match:
            table_name = match.group(1)
            if table_name in TABLES_TO_IMPORT:
                current_table = table_name
                capturing = True
                output_lines.append("")
                output_lines.append(line)
                i += 1
                continue
            else:
                current_table = table_name
                capturing = False
                i += 1
                continue
        
        # Detect AUTO_INCREMENT section
        match = re.search(r'AUTO_INCREMENT for table `(\w+)`', line)
        if match:
            table_name = match.group(1)
            if table_name in TABLES_TO_IMPORT:
                current_table = table_name
                capturing = True
                output_lines.append("")
                output_lines.append(line)
                i += 1
                continue
            else:
                current_table = table_name
                capturing = False
                i += 1
                continue
        
        if capturing:
            output_lines.append(line)
            captured_count += 1
        
        i += 1
    
    # Add footer
    output_lines.append("")
    output_lines.append("COMMIT;")
    
    # Write output
    with open(OUTPUT_FILE, 'w', encoding='utf-8') as f:
        f.write('\n'.join(output_lines))
    
    print(f"\nDone!")
    print(f"  Tables extracted: {len(tables_found)} of {len(TABLES_TO_IMPORT)}")
    print(f"  Tables found: {sorted(tables_found)}")
    
    missing = TABLES_TO_IMPORT - tables_found
    if missing:
        print(f"  WARNING - Missing tables: {sorted(missing)}")
    
    print(f"  WordPress tables skipped: {skipped_count}")
    print(f"  Lines captured: {captured_count:,}")
    print(f"  Output: {OUTPUT_FILE}")

if __name__ == '__main__':
    extract_tables()
