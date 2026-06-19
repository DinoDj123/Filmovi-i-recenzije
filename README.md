# Movies & Reviews (Laravel App)

A full-stack Laravel application for browsing movies and writing reviews.  
Users can register, log in, and manage their own movie reviews, while admins have full control over users and content.

**Live Demo:** https://filmovi-i-recenzije-production.up.railway.app

---

## Tech Stack

- Laravel (PHP)
- Blade / Tailwind CSS
- MySQL (or any Laravel-supported DB)
- Vite (frontend assets)
- Laravel Auth system

---

## Features

### User Features
- User registration and authentication
- Create, edit, and delete personal movie reviews
- Public movie listing with pagination (4 movies per page)
- Detailed movie view page
- Profile management (name, bio, profile picture upload)

### Movie System
- Movie catalog with posters and details
- Individual movie pages with user reviews
- Image upload support for posters and avatars

### Admin Panel
- Manage all user reviews (edit/delete)
- Delete users (their reviews are reassigned to Super Admin)
- View all registered users
- Full moderation control over content

---

## Installation

```bash
git clone https://github.com/DinoDj123/filmovi-i-recenzije.git

cd filmovi-i-recenzije

composer install

npm install

cp .env.example .env
# configure your DB and environment variables

php artisan key:generate

php artisan migrate --seed

php artisan storage:link

npm run dev

php artisan serve
```
App will be available at:

http://127.0.0.1:8000

After running migrations and seeders:

- Email: admin@gmail.com
- Password: admin123
## Storage Structure
- Movie posters: storage/app/public/posters
- User avatars: storage/app/public/avatars
- Default images included:
- default.jpg
- defaultAvatar.jpg

## Project Purpose

This project was built as a practical learning application to demonstrate:

- Full-stack Laravel development
- Authentication & authorization (roles: user/admin)
- CRUD operations with relational data
- File uploads and storage handling
- Clean UI with responsive design
- Basic admin moderation system