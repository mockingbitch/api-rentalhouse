#!/bin/sh
PHPCS_PATH=./tools/PHP/phpcs.phar
PHPCBF_PATH=./tools/PHP/phpcbf.phar
PHPMD_PATH=./tools/PHP/phpmd.phar
PRECOMMIT_PATH=./PHP/pre-commit

# install phpcs, phpcbf
if [ ! -f $PHPCS_PATH ]; then
    curl https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar --output $PHPCS_PATH
fi

if [ ! -f $PHPCBF_PATH ]; then
    curl https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar --output $PHPCBF_PATH
fi

if [ ! -f $PHPMD_PATH ]; then
    curl https://phpmd.org/static/latest/phpmd.phar --output $PHPMD_PATH
fi