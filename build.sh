#!/usr/bin/env bash

commit=$1
if [ -z ${commit} ]; then
    commit=$(git tag --sort=-creatordate | head -1)
    if [ -z ${commit} ]; then
        commit="master";
    fi
fi

# Remove old release
rm -rf FroshPerformance FroshPerformance-*.zip

# Build new release
mkdir -p FroshPerformance
git archive ${commit} | tar -x -C FroshPerformance
composer install --no-dev -n -o -d FroshPerformance
( find ./FroshPerformance -type d -name ".git" && find ./FroshPerformance -name ".gitignore" && find ./FroshPerformance -name ".gitmodules" ) | xargs rm -r
zip -r FroshPerformance-${commit}.zip FroshPerformance
