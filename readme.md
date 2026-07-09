# Marketing Agency Intranet

## Overview

This repository contains a standalone intranet platform designed for marketing agencies and creative teams.

The project centralizes internal workflows such as client management, projects, tasks, communication, files and team organization.

The system was designed to demonstrate the development of an internal business platform using Laravel, focusing on maintainable architecture, workflow organization and enterprise application patterns.

## Main Features

* Client management
* Project organization
* Task tracking
* Comments and collaboration
* File attachments
* Notifications
* User permissions
* Internal workflow management
* External service integrations

## Technology Stack

* PHP
* Laravel
* MySQL
* Blade Templates
* JavaScript
* Laravel Jobs
* Events and Listeners
* Composer
* Laravel Mix

## Architecture

The application follows a Laravel monolithic architecture:

```text
app/
 ├── Models
 ├── Controllers
 ├── Jobs
 ├── Events
 ├── Listeners
 └── Services

resources/
 ├── views/
 ├── js/
 └── sass/

database/
 ├── migrations
 └── seeders

routes/
 ├── web.php
 └── api.php
```

## Local Development

### Requirements

* PHP 7+
* Composer
* Node.js and npm
* MySQL/MariaDB

### Installation

Install PHP dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database settings in `.env`.

Run database migrations:

```bash
php artisan migrate --seed
```

Install frontend dependencies:

```bash
npm install
npm run dev
```

Start application:

```bash
php artisan serve
```

## Testing

Run automated tests:

```bash
./vendor/bin/phpunit
```

## Purpose

This project demonstrates the development of an internal business platform using Laravel, including:

* Business workflow management
* CRUD operations
* Database modeling
* Authentication and authorization
* Background processing with Jobs
* Event-driven features
* Enterprise application organization

## License

MIT License
