#!/bin/sh
set -e
cd /app

# Database SQLite dibuat saat pertama kali container menyala.
touch database/database.sqlite
php artisan migrate --force

# Isi data contoh hanya kalau tabel user masih kosong.
php -r '$db = new PDO("sqlite:database/database.sqlite"); exit($db->query("SELECT COUNT(*) FROM users")->fetchColumn() > 0 ? 0 : 1);' \
    || php artisan db:seed --force

php artisan config:cache
php artisan route:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
