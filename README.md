# ITS
Inventory Tracking System with following functionalities:
- Roles (Admin, Chairman, Lab Incharge, Data Entry Operator)
- Permissions
- User Module
- Can add/delete Labs
- Can add/delete Categories
- Can add/delete Inventory
- Can move inventory between Labs
- Can track which inventory is available in which lab and from where it has been going through

# PS: I will add edit/update module also along with dynamic roles/permission creation and updation. It's just beta version


# Steps:
- git clone "https://github.com/umersaeed3d/ITS.git"
- composer install
- cp .env.example .env
- Enter your DB credentails in .env file
- php artisan key:generate
- php artisan migrate --seed
- php artisan serve

Password for every dummy user is "12345678"
Open browser and type 127.0.0.1:8000, make sure MySQL connection is active.

# Technologies Used:
- PHP
- Laravel 9
- MySQL
- HTML
- CSS
