# QR Event Ticketer

Laravel 12, PHP 8.3, MongoDB, Blade, and Tailwind CSS application for QR-coded event registration and admin check-in.

## Architecture

- `app/Models`: MongoDB Eloquent documents for `events`, `attendees`, and `users`.
- `app/Repositories`: persistence contracts and MongoDB-backed implementations.
- `app/Services`: business rules for events, registration, QR generation, check-in, dashboard metrics, and tickets.
- `app/Http/Requests`: Form Request validation for web and API input.
- `app/Http/Resources`: consistent API responses using `{ success, message, data }`.
- `app/Http/Controllers`: thin HTTP coordinators.
- `resources/views`: Blade UI with Tailwind CSS.
- `tests`: feature and unit coverage for core flows.

## Project Structure

```text
app/
  Enums/
  Http/Controllers/{Admin,Api,Auth}
  Http/Middleware/
  Http/Requests/
  Http/Resources/
  Models/
  Providers/
  Repositories/Contracts/
  Services/
database/
  factories/
  seeders/
resources/
  css/
  js/
  views/
routes/
  api.php
  web.php
tests/
  Feature/
  Unit/
```

## Composer Packages

- `laravel/framework`
- `mongodb/laravel-mongodb`
- `endroid/qr-code`
- `laravel/pint`
- `phpunit/phpunit`

## MongoDB Collections

Create or inspect these collections in MongoDB Compass inside the `qr_event_ticketer` database:

- `events`
- `attendees`
- `users`

The application creates documents automatically through Eloquent MongoDB models. Useful indexes are seeded by the application command notes below: unique attendee email per event, unique ticket code, and unique user email.

### Collection Shapes

```json
{
  "events": {
    "_id": "",
    "title": "",
    "description": "",
    "location": "",
    "event_date": "",
    "capacity": 0,
    "status": "active"
  },
  "attendees": {
    "_id": "",
    "event_id": "",
    "full_name": "",
    "email": "",
    "phone": "",
    "ticket_code": "",
    "qr_code_path": "",
    "checked_in": false,
    "checked_in_at": null
  },
  "users": {
    "_id": "",
    "name": "",
    "email": "",
    "password": "",
    "role": "admin"
  }
}
```

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
npm install
npm run build
php artisan db:seed
php artisan serve
```

Set MongoDB in `.env`:

```env
DB_CONNECTION=mongodb
MONGODB_URI=mongodb://127.0.0.1:27017
MONGODB_DATABASE=qr_event_ticketer
ADMIN_API_TOKEN=change-this-long-random-token
```

Default seeded admin:

```text
admin@example.com / password
```

Sample seeded event:

```text
Laravel QR Summit 2026
Singapore Expo
```

## API Endpoints

All API responses use:

```json
{
  "success": true,
  "message": "",
  "data": {}
}
```

Available endpoints:

```text
GET /api/events
GET /api/events/{id}
POST /api/register
POST /api/checkin
GET /api/ticket/{code}
```

`POST /api/register` body:

```json
{
  "event_id": "event-id",
  "full_name": "Ada Lovelace",
  "email": "ada@example.com",
  "phone": "+6590000000"
}
```

`POST /api/checkin` accepts either:

Header:

```text
Authorization: Bearer your-admin-api-token
```

```json
{
  "ticket_code": "EVT-2026-000001"
}
```

or a decoded QR payload:

```json
{
  "payload": {
    "ticket_code": "EVT-2026-000001",
    "event_id": "event-id",
    "attendee_id": "attendee-id"
  }
}
```

## Tests

```bash
php artisan test
./vendor/bin/pint
```

## VPS Deployment Notes

Use Ubuntu with Nginx, PHP-FPM 8.3, Composer, Node.js, and MongoDB. Point Nginx to `public/`, set secure `.env` values, run `composer install --no-dev --optimize-autoloader`, `npm ci && npm run build`, `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`, and `php artisan storage:link`.

Ensure `storage/` and `bootstrap/cache/` are writable by the PHP-FPM user.

Enable the PHP MongoDB and GD extensions:

```bash
sudo apt install php8.3-mongodb php8.3-gd
```
