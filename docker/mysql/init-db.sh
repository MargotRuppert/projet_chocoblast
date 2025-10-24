#!/bin/bash
set -e

echo "Initialisation de la base de données..."

# Attendre que MySQL soit prêt
sleep 2

# Exécuter le script SQL sur la base de données chocoblast
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" "${MYSQL_DATABASE}" < /docker-entrypoint-initdb.d/02-db.sql

echo "Base de données initialisée avec succès !"