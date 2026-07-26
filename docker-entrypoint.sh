#!/bin/sh
set -e

# Create .env if missing
if [ ! -f /var/www/.env ]; then
    echo "Creating .env file from .env.example..."
    cp /var/www/.env.example /var/www/.env
fi

# Wait for MySQL connection if DB_HOST is set to 'db'
if [ "$DB_HOST" = "db" ]; then
    echo "Waiting for MySQL database connection..."
    php -r '
    $host = getenv("DB_HOST") ?: "db";
    $port = getenv("DB_PORT") ?: 3306;
    $user = getenv("DB_USERNAME") ?: "root";
    $pass = getenv("DB_PASSWORD") ?: "secretpassword";
    
    for ($i = 0; $i < 30; $i++) {
        try {
            $pdo = new PDO("mysql:host=$host;port=$port", $user, $pass);
            echo "Connected to MySQL successfully!\n";
            exit(0);
        } catch (PDOException $e) {
            sleep(2);
        }
    }
    echo "Could not connect to MySQL database.\n";
    exit(1);
    '
fi

# Execute essential Artisan commands
echo "Running Laravel Artisan commands..."
php artisan key:generate --no-interaction --force || true
php artisan storage:link --no-interaction --force || true
php artisan migrate --force || true
php artisan db:seed --force || true
php artisan l5-swagger:generate || true
php artisan config:clear
php artisan route:clear

echo "Application is ready!"
exec "$@"
