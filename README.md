# Movies and Reviews

>Terminal commands:

1. git clone https://github.com/DinoDj123/filmovi-i-recenzije.git

2. cd filmovi-i-recenzije

3. composer install

4. npm install

5. cp .env.example .env (edit the env file if needed)

6. php artisan key:generate

7. php artisan migrate --seed

8. php artisan storage:link

9. npm run dev

10. php artisan serve / php 127.0.0.1:8000 -t public (in a new terminal)

>Features

- User registration and login

- Adding, editing, and deleting personal movie reviews

- Profile editing (name, description, profile picture)

- Public movie list with pagination (4 per page)

- Detailed movie view

>Admin panel:

- Edit and delete any review

- Delete users (all their reviews get reassigned to the Super Admin)

- User list

>Admin
- After seeding and migration, login as admin:

Name: admin

Email: admin@gmail.com

Password: admin123

>Images:

- Initially, there are 2 default images: default.jpg and defaultAvatar.jpg

Movie posters: /storage/app/public/posters

User avatars: /storage/app/public/avatars