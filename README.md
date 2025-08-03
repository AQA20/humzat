# Humzat API

A modern RESTful API built with **Laravel 12** and **PostgreSQL**, designed for powering a news aggregator and micro-post platform similar to Twitter. It supports user registration, authentication, content posting, media attachments, unique view/share tracking, and third-party media embedding. 

## ⚙️ Tech Stack

- **Framework**: Laravel 12
- **Database**: PostgreSQL
- **Authentication**: Laravel Sanctum
- **Media Storage**: Amazon S3 with CloudFront
- **Deployment**: GitHub Actions → Amazon ECS (no Docker)
- **Testing**: PHPUnit
- **Code Quality**: PHPStan, Laravel Pint

---

## 🚀 Features

- ✅ User Registration & Login
- ✅ `/me` and `/logout` endpoints
- ✅ Article and Twitter-style Post support
- ✅ External link deduplication
- ✅ Image & Video uploads via S3 with signed CloudFront URLs
- ✅ Unique view & share tracking (per IP/UUID per 24h)
- ✅ Commenting, replies, likes, shares, saves
- ✅ Hashtags and media tagging
- ✅ Dynamic content ingestion via Laravel API from TypeScript frontend

---

## 🧑‍💻 Local Development Setup

### Requirements

- PHP 8.3
- Composer 2
- PostgreSQL (e.g., 15+)
- Node.js (optional for frontend)
- Redis (optional for queue/cache)

### 1. Clone the repository

```bash
git clone https://github.com/your-username/humzat-api.git
cd humzat-api
```

### 2. Install dependencies

```bash
composer install
```

### 3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```
#### Update your .env with:

```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=humzat
DB_USERNAME=postgres
DB_PASSWORD=yourpassword

AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=...
AWS_BUCKET=your-bucket
CLOUDFRONT_URL=https://your-distribution.cloudfront.net
```


### 4. Run database migrations

```bash
php artisan migrate
```

### 5. Running Tests

```bash
cp .env.testing .env
php artisan migrate --env=testing
php artisan test
```
#### You can also run static analysis:

```bash
vendor/bin/phpstan analyse
vendor/bin/pint
```

---

### 📦 Deployment (via GitHub Actions → ECS)
#### This project uses GitHub Actions to test and deploy to Amazon ECS (Fargate).


### 6. 🔐 Authentication
#### This API uses Laravel Sanctum for token-based auth.


### 📝 License
### MIT License © Ahmad AbuDawaba
