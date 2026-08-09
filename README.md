## ⚙️ Installation Guide

### 1️⃣ Clone the Repository

git clone https://github.com/Kamrulewucse/jsk-hrm.git
cd jsk-hrm

2️⃣ Install Dependencies
composer install

3️⃣ Create Environment File
cp .env.example .

Update the following in .env:
File Path: htdocs\jsk-hrm\vendor\spatie\laravel-permission\src\Models\Permission.php
Above Model add below relations
public function parent()
{
return $this->belongsTo(Permission::class);
}

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

APP_NAME="JSK HRM"
DB_DATABASE=jsk_hrm
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Run Migrations and Seeders

php artisan migrate
php artisan db:seed

5️⃣ Serve the Application
php artisan serve
