# PMD SaaS Starter

A secure, scalable, and modern enterprise application boilerplate built with **Laravel 13+**, **MoonShine v4**, and **Tailwind CSS 4**. This platform is designed with a strong emphasis on security, strict Role-Based Access Control (RBAC), and developer experience.

## Features

- **Enterprise Authentication:** Powered by Laravel Fortify with strict rate limiting and 2FA support.
- **Modern Admin Dashboard:** MoonShine v4, integrated with Fortify and Spatie Permissions.
- **Strict RBAC:** Granular Role-Based Access Control (Admin, Editor, Contributor) via Spatie Permission.
- **Secure API Layer:** Laravel Restify v10 with policy-driven authorization and shaped JSON responses.
- **Security First:** Enforced via Content Security Policy (CSP), Roave Security Advisories, and Mews Purifier.
- **Audit Trails:** Comprehensive activity logging for critical state changes.
- **Modern Frontend:** Tailwind CSS 4 (CSS-first configuration) with Vite and Laravolt Avatars.

## Technology Stack

| Category | Technology | Version |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel | 13+ (requires PHP 8.4+) |
| **Authentication** | Laravel Fortify | `^1.41` |
| **Admin Panel** | MoonShine | `^4.19` |
| **Authorization** | Spatie Laravel Permission | `^8.3` |
| **Activity Logging** | Spatie Laravel Activitylog | `^5.1` |
| **Media Management** | Spatie Laravel Media Library | `^11.23` |
| **API Management** | Laravel Restify | `^10.4` |
| **Frontend Styling** | Tailwind CSS | `4.x` |
| **Avatars** | Laravolt Avatar | `^7.0` |
| **HTML Sanitization** | Mews Purifier | `^3.4` |
| **Security Headers** | Spatie Laravel CSP | `^3.29` |
| **Dependency Security** | Roave Security Advisories | `dev-latest` |

## Prerequisites

Before you begin, ensure the following are installed on your local machine:

- **PHP** >= 8.4
- **Composer**
- **Node.js** and **NPM**
- **MySQL** or **PostgreSQL**

## Installation & Setup

### 1. Clone the repository

Replace the placeholders with your actual repository URL and project directory.

```bash
git clone <repository-url>
cd <project-directory>
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure the environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure the database and run migrations

Update your `.env` file with your database credentials, then run:

```bash
php artisan migrate --seed
```

### 5. Build frontend assets

```bash
npm run build
```

### 6. Start the development server

```bash
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`. The admin panel is located at `http://127.0.0.1:8000/admin`.
        - Username: admin@example.com
        - Password: password

## Architecture & Conventions

### Authentication & Admin Panel

- Laravel Fortify handles backend authentication logic, including login, registration, password reset, email verification, and two-factor authentication (2FA).
- MoonShine is configured to use Fortify's web guard.
- Do not use MoonShine's default authentication; rely on Fortify's middleware and session handling.

### API Development

- Laravel Restify is used for API endpoints.
- All API routes are versioned and strictly throttled.
- Eloquent models must not be returned directly. Use Restify Repositories to shape JSON responses and prevent internal schema leakage.
- Authorization is handled through Policies, such as `allowRestify` and `allowToIndex`.

### Frontend & UI

- Tailwind CSS 4 is used for styling.
- Custom theme extensions must be added through the `@theme` directive in `resources/css/app.css`.
- Laravolt Avatar generates consistent default avatars for users based on their names.
- External resources, such as fonts, must be explicitly whitelisted in the custom CSP preset (`App\Policies\CspPolicy`).

### Media & Activity

- Spatie Media Library handles file uploads.
- Files must be validated by MIME type, not only by extension. SVG uploads are blocked by default.
- Spatie Activitylog is integrated into critical models (`User`, `Post`, `Category`, and `Role`) to maintain an audit trail.

## Security & Best Practices

Security is built into the development lifecycle. All contributors must adhere to the following standards.

### Core Security Mechanisms

- **Mass Assignment Protection:** Models must strictly define `$fillable` arrays. Using `$guarded = []` is prohibited.
- **Authorization (Policies & Gates):** Every Eloquent model must have a corresponding Policy. Authorization checks, such as `$this->authorize()` or `Gate::allows()`, must be enforced server-side. Never rely solely on route middleware.
- **XSS Prevention:** All Blade outputs must use escaped syntax (`{{ }}`). Rich-text inputs, such as editorial post content, must be sanitized using Mews Purifier before database insertion.
- **Data Integrity:** Financial and multi-table state changes must be wrapped in `DB::transaction()`.
- **Soft Deletes:** Critical entities (`User`, `Post`, and `Category`) use the `SoftDeletes` trait to preserve audit trails.

### Environment & Configuration

- Never commit `.env` files. Only `.env.example` should be committed.
- In production, `APP_DEBUG` must be `false` and `APP_ENV` must be `production`.
- The application uses `spatie/laravel-csp` to enforce Content Security Policy, `X-Frame-Options`, `X-Content-Type-Options`, and HTTP Strict Transport Security (HSTS).

### Developer Security Checklist

Before submitting a pull request, verify the following:

- [ ] Is all user input validated using a Form Request?
- [ ] Are Policies/Gates applied to all state-changing actions?
- [ ] Are Blade variables output using `{{ }}` (or sanitized if HTML is required)?
- [ ] Does each model have a strictly defined `$fillable` array?
- [ ] Are MIME types checked and filenames hashed for file uploads?
- [ ] Are API keys and credentials stored in `.env` and never hardcoded?
- [ ] Have you run `composer audit` to check for vulnerable packages?

## Testing & CI/CD

### Running Tests

The test suite includes explicit tests for authorization (IDOR), mass assignment, and authentication bypasses.

```bash
php artisan test
```

### Static Analysis

Larastan (PHPStan) is integrated to catch type errors and potential logic flaws.

```bash
vendor/bin/phpstan analyse
```

### CI Pipeline

The project uses GitHub Actions (`.github/workflows/ci.yml`) to enforce:

- `composer audit` and `npm audit` for dependency security.
- Larastan static analysis.
- The full PHPUnit test suite.

## License

Copyright © 2026 PMD SaaS Starter. All rights reserved.
