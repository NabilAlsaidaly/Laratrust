🚀 Laratrust – Solar Energy & Equipment Management Platform

Laratrust is a Laravel-based platform designed for managing solar energy equipment, companies, technicians, batteries, inverters, bills, categories, and customer interactions.
It includes a full-featured Admin Dashboard, Company Dashboard, and User Interface, with authentication powered by Laravel Jetstream, Fortify, Sanctum, and Livewire.

This project demonstrates a complete, production-ready system for managing renewable energy services and products.

📌 Key Features
✅ User Features

Browse solar panels, batteries, inverters, and other products

View product details with images

Submit contact messages and inquiries

Search across products and categories

User registration, login, 2FA (via Jetstream)

🏢 Company Dashboard

Companies can:

Add and manage:

Solar panels

Batteries

Inverters

Technicians

Bills / purchases

Categories

Update or delete existing items

View detailed statistics and listings

Manage their own inventories and technicians

🛠️ Admin Dashboard

Admins can:

Manage all users, companies, categories, technicians, messages

View all system activity

Review and update user accounts

Access advanced dashboard UI with Bootstrap admin templates

⚙️ System Architecture Overview

Built using Laravel's modular system:

Component Description
Laravel Jetstream + Fortify Authentication, profile, 2FA, sessions
Livewire Reactive UI components
Sanctum API token authentication
MVC Controllers Clean separation of Admin, Company, and User logic
Blade Templates Fully customized UI system for admin and user
SCSS / Bootstrap / JS Libraries Modern UI/UX for dashboards and product pages
📁 Project Structure (Simplified)
app/
├── Http/
│ ├── Controllers/ → Admin, Company, User controllers
│ ├── Middleware/ → Role-based access (Admin / Company / User)
│
├── Models/ → Battery, SolarPanel, Company, Technician, Category...
├── Actions/ → Jetstream account management handlers
├── Providers/ → Jetstream, Fortify, App providers

resources/
├── views/
│ ├── admin/ → Admin panel templates
│ ├── company/ → Company dashboard
│ ├── home/ → User-facing pages
│ ├── auth/ → Login, register, 2FA
│ └── components/ → Reusable UI components
public/
│ ├── Battery/
│ ├── Inverter/
│ ├── SolarPanel/
│ ├── Technician/
│ └── UI assets (CSS/JS/Images)

🛠️ Installation & Setup

1. Clone the Repository
   git clone https://github.com/YourUsername/Laratrust.git
   cd Laratrust

2. Install Dependencies
   composer install
   npm install

3. Configure Environment
   cp .env.example .env
   php artisan key:generate

Update database credentials in .env.

4. Run Migrations
   php artisan migrate

5. Start Development Server
   php artisan serve
   npm run dev

🔐 Authentication (Jetstream)

This project includes complete authentication support:

Email verification

Reset password

Two-factor authentication

Session management

Profile update pages

📸 Media Storage

All uploaded images (solar panels, technicians, batteries…) are stored under:

/public/Battery
/public/SolarPanel
/public/Inverter
/public/Technician

You can use Laravel Storage for production deployment (S3, DigitalOcean Spaces, etc.).

🧪 Testing

Laravel’s testing suite is included:

php artisan test

Feature tests cover:

Authentication

Password reset

Email verification

Profile updates

2FA

📄 License

This project is open-source and available under the MIT License.

💬 Notes

This project is part of your portfolio and demonstrates a full commercial-level system.

You can extend it with APIs, mobile integration, or external energy system data sources.

All assets under /public are used for UI demonstration.
