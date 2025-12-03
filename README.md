# MX100 Job Portal API

MX100 adalah job portal sederhana yang menghubungkan **employer** dan **freelancer**, dibangun menggunakan **Laravel 12**, Sanctum, dan Spatie Permission.

## Fitur Utama
### Employer
- Membuat & mengelola lowongan (draft/published)
- Melihat pelamar & CV

### Freelancer
- Melihat job published
- Melamar job (upload CV)

## Instalasi Cepat
```
composer install
cp .env.example .env
php artisan key:generate
php artisan install:api
php artisan migrate --seed
php artisan serve
```

Sample user:
- Employer → employer@mx100.test / password  
- Freelancer → freelancer1@mx100.test / password  

## Autentikasi
Gunakan token Sanctum:
```
Authorization: Bearer <token>
```

## API Utama

### Auth
- POST `/api/v1/register`
- POST `/api/v1/login`

### Employer
- GET `/api/v1/employer/jobs`
- POST `/api/v1/employer/jobs`
- PUT `/api/v1/employer/jobs/{job}`
- GET `/api/v1/employer/jobs/{job}/applications`

### Freelancer
- GET `/api/v1/freelancer/jobs`
- GET `/api/v1/freelancer/jobs/{job}`
- POST `/api/v1/freelancer/jobs/{job}/apply`

## Struktur Folder Singkat
```
app/
  Models/
  Services/
  Http/
    Controllers/Api/V1/
    Requests/
    Resources/
database/
  seeders/
```

## Postman
- Response script otomatis menyimpan token ke variable `token`
- Semua request menggunakan header:
```
Authorization: Bearer {{token}}
```
