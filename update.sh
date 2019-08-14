#!/bin/bash
git pull
composer dump-env dev
php bin/console cache:clear --no-warmup
php bin/console cache:warmup