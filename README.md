# ☕ Sip & Snug - Coffee House & Cafe E-Commerce System

<p align="center">
  <img src="public/front/photos/coffee/coffee%20cate.jpg" width="100%" style="border-radius: 15px;" alt="Sip & Snug Banner">
</p>

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com)
[![Swagger](https://img.shields.io/badge/Swagger-OpenAPI%203.0-85EA2D?style=for-the-badge&logo=swagger)](https://swagger.io)

An end-to-end e-commerce system and RESTful API backend for **Sip & Snug Cafe**. Built with **Laravel 11**, this project powers both mobile and web clients through secure API endpoints, alongside a dynamic customer-facing frontend (Blade + AJAX) and a comprehensive Admin Management Dashboard.

---

## 📑 Table of Contents
1. [🚀 Tech Stack](#-tech-stack)
2. [✨ Key Features](#-key-features)
   - [👤 Customer Features](#-customer-features)
   - [🛡️ Admin Dashboard](#️-admin-dashboard)
3. [🗄️ Database Architecture](#️-database-architecture)
4. [🔌 API & Swagger Documentation](#-api--swagger-documentation)
5. [🛠️ Installation & Setup Guide](#️-installation--setup-guide)
6. [🧪 Running Tests](#-running-tests)

---

## 🚀 Tech Stack

### **Backend Framework & Core**
* **PHP 8.3** & **Laravel 11.x**
* **Laravel Sanctum**: API token management and stateful session authentication.
* **MySQL 8.0**: Relational database storage with Eloquent ORM relationships.
* **L5-Swagger (OpenAPI 3.0)**: Interactive API documentation and specification generator.
* **Clean Architecture**: Domain-driven folder structures for Controllers (`Web`, `Api`, `Admin`, `Auth`, etc.).
* **FormRequest Validation**: Strict, dedicated validation classes separating business logic from controllers.

### **Frontend & UI**
* **Blade Templating Engine**: Server-rendered layouts for customer storefront and admin panel.
* **Bootstrap 5.3 & Vanilla CSS**: Modern, responsive styling.
* **JavaScript (jQuery & Fetch API / AJAX)**: Asynchronous shopping cart interactions, live popups, and real-time updates without page reloads.
* **AOS, Swiper.js, Magnific Popup, FontAwesome 6**: Rich visuals, animations, and sliders.

---

## ✨ Key Features

### 👤 Customer Features
* **Interactive Menu & Categories:** Browse categories (Coffee, Fresh Juices, Refreshers, Smoothies, Matcha) and subcategories with instant filtering.
* **Product Customization Modal:**
  * Adjust quantity dynamically.
  * Select custom drink add-ons and toppings.
  * View preparation time, calories, ratings, and descriptions.
* **Dynamic Shopping Cart:**
  * Add, update, and remove items seamlessly via AJAX.
  * Real-time subtotal computation and badge counter updates.
* **Checkout & Delivery Management:**
  * Select delivery zones with calculated delivery fees.
  * Manage saved delivery addresses.
* **Order History & Live Tracking:** Review past orders and track order statuses in real time.
* **Favorites System (Wishlist):** Save favorite drinks and items with a single click.
* **Additional Engagement Services:** Table reservations, contact form submissions, and live support chat.

---

### 🛡️ Admin Dashboard
* **Analytics Overview:** Monitor overall sales metrics, active orders, customer counts, and key performance metrics.
* **Products & Categories Management (CRUD):**
  * Create, update, and delete products, pricing, calories, prep time, and product images.
  * Manage categories, subcategories, and drink add-ons.
* **Order Fulfillment System:**
  * View all customer orders and full item breakdowns with add-ons.
  * Update order statuses (`pending`, `preparing`, `out_for_delivery`, `delivered`, `canceled`).
* **Delivery Zone Management:** Define supported zones and configure zone-specific delivery fees.

---

## 🗄️ Database Architecture

The system database schema uses structured Eloquent relationships:

| Table | Description |
| :--- | :--- |
| `users` | User accounts, roles (`admin` or `customer`), profile metadata, and images. |
| `categories` | Top-level product categories (e.g., Coffee, Smoothies). |
| `subcategories` | Sub-groupings linked to parent categories. |
| `products` | Product catalog details (name, price, calories, prep time, image, ratings). |
| `add_ons` & `product_addons` | Drink customizations, extra toppings, and product mappings. |
| `carts` & `cart_items` | Persistent user shopping carts, selected add-ons, and item quantities. |
| `orders`, `order_items`, `order_item_addons` | Order history, line-item pricing, selected add-ons, and delivery status. |
| `addresses` | Saved customer delivery addresses. |
| `delivery_zones` | Supported delivery geographic zones and associated shipping rates. |
| `favorites` | Customer saved product wishlist items. |
| `contact_messages`, `reservations`, `subscribers` | Contact inquiries, table reservations, and newsletter subscribers. |

---

## 🔌 API & Swagger Documentation

The project includes built-in interactive **Swagger / OpenAPI** documentation to easily explore and test API endpoints.

📍 **Swagger API Documentation URL:**
```http
http://127.0.0.1:8000/api/documentation
```

### Key API Endpoints Overview:

#### 🔓 **Public API Endpoints**
* `GET /api/v1/products` - Retrieve list of products.
* `GET /api/v1/products/{id}` - Get single product details.
* `GET /api/v1/categories` - Get main product categories.
* `GET /api/v1/subcategories` - Get subcategories.
* `GET /api/v1/add-ons` - List available add-ons.
* `GET /api/v1/delivery-zones` - List active delivery zones and fees.

#### 🔒 **Protected Customer API Endpoints (Requires Auth)**
* `GET /api/v1/cart` - View authenticated user's cart.
* `POST /api/v1/cart/items` - Add item to cart.
* `PUT /api/v1/cart/items/{id}` - Update cart item quantity.
* `DELETE /api/v1/cart/items/{id}` - Remove item from cart.
* `GET /api/v1/orders` - View customer order history.
* `POST /api/v1/orders` - Place a new order (Checkout).
* `GET /api/v1/addresses` - Manage delivery addresses (CRUD).

#### 🛡️ **Admin API Endpoints (Requires Admin Role)**
* `GET /api/v1/admin/orders` - List all store orders.
* `PUT /api/v1/admin/orders/{id}/status` - Update order fulfillment status.
* `POST / PUT / DELETE /api/v1/admin/products` - Full product management.
* `POST / PUT / DELETE /api/v1/admin/categories` - Full category management.

---

## 🛠️ Installation & Setup Guide

### 🐳 Quick Start with Docker (Recommended)

Run the entire stack (Laravel, PHP 8.3, Nginx, MySQL 8.0, Swagger) with a single command:

```bash
# 1. Clone the repository
git clone https://github.com/nouransherif0/G2_NTI_Laravel.git
cd G2_NTI_Laravel

# 2. Build and start containers
docker compose up -d --build
```

The application automatically handles database waiting, environment configuration, migrations, database seeding, storage linking, and Swagger API generation.

- **Web Application:** `http://127.0.0.1:8000`
- **Swagger API Docs:** `http://127.0.0.1:8000/api/documentation`

---

### 💻 Manual Local Setup

If you prefer to run PHP and MySQL directly on your host machine:

### 1. Prerequisites

* PHP >= 8.3
* Composer
* MySQL Database Server

### 2. Step-by-Step Setup

```bash
# 1. Clone the Repository
git clone https://github.com/nouransherif0/G2_NTI_Laravel.git
cd G2_NTI_Laravel

# 2. Install PHP Dependencies
composer install

# 3. Create Environment File
cp .env.example .env

# 4. Generate Application Key
php artisan key:generate

# 5. Configure Database in .env
# Edit your database credentials:
# DB_DATABASE=NTI
# DB_USERNAME=root
# DB_PASSWORD=your_password
# SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000,127.0.0.1:8001,localhost:8000,localhost:8001,localhost,127.0.0.1

# 6. Run Migrations & Seeders
php artisan migrate --seed

# 7. Create Storage Symbolic Link
php artisan storage:link

# 8. Generate Swagger API Documentation
php artisan l5-swagger:generate

# 9. Start Local Development Server
php artisan serve
```

Access the application at `http://127.0.0.1:8000`  
Access Swagger API Docs at `http://127.0.0.1:8000/api/documentation`

---

## 🧪 Running Tests

The application includes unit and feature test suites powered by PHPUnit to verify API endpoints, authentication, cart functionality, and order processing:

```bash
# Run all test suites (72+ robust tests covering Web and API routes)
php artisan test

# Run specific feature tests
php artisan test --filter=CustomerRoutesTest
php artisan test --filter=AdminRoutesTest
```

---

<p align="center">
  Crafted with ❤️ for <b>Sip & Snug Coffee House</b>
</p>
