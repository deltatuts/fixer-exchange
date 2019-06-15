#!/usr/bin/env bash

cp -r phpcs.xml.dist phpcs.xml
cp -r phpunit.xml.dist phpunit.xml

cp git-hooks/pre-commit .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit
