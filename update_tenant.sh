#!/bin/bash
php bin/console doctrine:schema:update --tenant=$1 --force --no-interaction --quiet