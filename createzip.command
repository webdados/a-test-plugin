#! /bin/bash

cd /Users/marcoalmeida/Documents/Websites/_local/wordpress-testing/app/public/wp-content/plugins/

rm a-test-plugin.zip

# Read .distignore and convert to zip exclusions
echo "Reading exclusions from .distignore..."
EXCLUSIONS=""
while IFS= read -r line || [ -n "$line" ]; do
    # Trim whitespace
    line=$(echo "$line" | xargs)
    # Skip empty lines and comments (lines starting with #)
    if [[ -n "$line" && ! "$line" =~ ^# ]]; then
        EXCLUSIONS="$EXCLUSIONS -x $line"
    fi
done < "a-test-plugin/.distignore"

echo "Using exclusions from .distignore: $EXCLUSIONS"
zip -r "a-test-plugin.zip" "a-test-plugin" $EXCLUSIONS