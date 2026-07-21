# 🍽️ Food Blog CMS

A web-based **Food Blog Content Management System (CMS)** developed using **Laravel 13**. The system allows administrators to manage food-related articles, categories, and users, while composers can create and submit blog posts for approval before publication.

---

## 📖 Project Overview

The Food Blog CMS provides a centralized platform for publishing food-related content such as recipes, restaurant reviews, cooking tips, and food experiences. It follows a role-based workflow where composers submit articles and administrators review and publish them.

This project was developed as the **Final Project** for the **Advanced Programming** course.

---

## ✨ Features

### Guest Users
- Browse published food articles
- Search posts by title
- Filter posts by category
- Read complete blog articles
- View related posts
- Like published posts
- Comment on posts (authenticated users)

### Composer
- Secure login
- Dashboard
- Create new posts
- Upload featured images
- Save posts as Draft
- Submit posts for approval
- Edit and delete own posts

### Administrator
- Dashboard with statistics
- Manage blog posts
- Approve or reject submitted posts
- Manage categories
- Manage user roles
- Publish articles
- Delete posts

---

## 🛠️ Built With

- Laravel 13
- PHP 8.3+
- MySQL
- Blade Templates
- Tailwind CSS
- Laravel Breeze
- Spatie Laravel Permission
- CKEditor 5
- Vite

---

## 🗄️ Database

Main tables:

- Users
- Roles
- Categories
- Posts
- Comments
- Likes

Relationships:

- One User → Many Posts
- One Category → Many Posts
- One Post → Many Comments
- One Post → Many Likes

---

## 🚀 Installation

### Clone the repository

```bash
git clone https://github.com/EleZ4r/food-blog-cms.git
```

### Open the project

```bash
cd food-blog-cms
```

### Install PHP dependencies

```bash
composer install
```

### Install Node dependencies

```bash
npm install
```

### Create the environment file

```bash
cp .env.example .env
```

### Generate the application key

```bash
php artisan key:generate
```

### Configure your database

Update your `.env` file:

```env
DB_DATABASE=food_blog
DB_USERNAME=root
DB_PASSWORD=
```

### Run migrations and seeders

```bash
php artisan migrate --seed
```

### Create the storage link

```bash
php artisan storage:link
```

### Build frontend assets

```bash
npm run dev
```

### Start the server

```bash
php artisan serve
```

Open:

```
http://127.0.0.1:8000
```

---

## 👥 User Roles

### Administrator

Can:

- Manage users
- Manage categories
- Manage all posts
- Approve or reject submitted posts
- Publish articles

### Composer

Can:

- Create posts
- Upload images
- Save drafts
- Submit posts for approval
- Edit own posts

---

## 📂 Project Structure

```
app/
├── Http/
│   └── Controllers/
├── Models/
resources/
├── views/
│   ├── admin/
│   ├── composer/
│   ├── layouts/
│   └── auth/
routes/
database/
public/
```

---

## 📚 Course Information

**Course:** Advanced Programming

**Project:** Food Blog CMS

---

## 👨‍💻 Developers

- John Eleazar S. Mamangun
- Railey C. Aquino
- Gwen Mae D. Barrozo
- Maria Stephanie G. Chavez
- Ken Aeron C. Daniega
- John Paul A. Escario
- Galileo U. Garcia

---

## 📄 License

This project was developed for educational purposes as a final academic requirement.