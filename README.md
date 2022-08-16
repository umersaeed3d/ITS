# ITS
Inventory Tracking System


Steps:
- git clone "https://github.com/umersaeed3d/ITS.git"
- composer install
- cp .env.example .env
- Enter your DB credentails in .env file
- php artisan key:generate
- php artisan migrate --seed
- php artisan serve

Go to browser and check 127.0.0.1:8000
