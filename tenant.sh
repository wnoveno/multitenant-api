#!/bin/bash
echo "Adding new tenant"
# php bin/console api:new-tenant $1
echo $1
php bin/console doctrine:database:drop --tenant=$1 --if-exists --no-interaction --force --quiet
echo "Creating  Tenant DB"
php bin/console doctrine:database:create --tenant=$1 --if-not-exists --no-interaction --quiet
php bin/console doctrine:schema:create --tenant=$1 --no-interaction --quiet