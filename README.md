
<img src="https://banners.beyondco.de/WeRoad.png?theme=light&packageManager=&packageName=&pattern=architect&style=style_1&description=&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Laravel Eloquent Toggle"/>


# A simple API Project for WeRoad

## Installation

1. Clone the repository
2. Create a DB and update the .env file
3. Run `composer install`
4. Run `php artisan migrate`
5. Run `php artisan db:seed`

The seed command will create two users:

1. `admin@example.com` with password `admin_password`: this user is an admin
2. `editor@example.com` with password `editor_password`: this user is an editor


## Commands

1. Run tests with `composer test`
2. Run PHPStan with `composer phpstan`
3. Run Pint with `composer format`

## API Endpoints

1. `POST /api/auth/login` - Logins a user and returns a token

2. `POST /api/admin/travels` - Creates a Travel
- Requires a valid token
- Requires the user to be an admin

3. `POST /api/admin/travels/{travel}/tours` - Creates a Tour
- Requires a valid token
- Requires the user to be an admin

4. `PUT /api/admin/travels/{travel}` - Edits a Travel
- Requires a valid token
- Requires the user to be an editor

5. `POST /api/search` - Searches for Tours

You can use the Postman collection, `WeRoad.postman_collection.json`, located in the root folder of this project to test the API.

## Description

This is a simple API project for WeRoad. It has a simple authentication system and two roles: admin and editor.
The authentication system is based on Laravel Sanctum and the permissions are managed with Laravel Policies (TravelPolicy and TourPolicy).

API routes are located in the `routes/api.php` file.



### Packages

For this project, I used the following packages:

- Laravel Data: to manage requests and data objects
- Laravel Sluggable: to create slugs automatically
- Laravel Sanctum: for authentication
- Pest: for testing
- PHPStan: for static analysis
- Pint: for code formatting
- Faker: for seeding the database

### Actions

The project has the following actions:

- Create a Travel
- Create a Tour
- Edit a Travel

### Search behavior

I recently read this article: https://muhammedsari.me/unorthodox-eloquent and wanted to try the approach of a Pipeline
used for queries so I implemented it in this project. 
The pipeline is located in the `app/Actions/Search/SearchTours.php` file.

## Tests

It's possible to run the tests with `composer test` or `./vendor/bin/pest`. The tests are located in the `tests` folder and are written with Pest.

## PHPStan

It's possible to run PHPStan with `composer analyse` . The PHPStan configuration is located in the `phpstan.neon.dist` file.


## Development efforts

I spent around 10 hours for this project. I mainly worked during lunch breaks and in the evening, with the exception of 
Friday afternoon (2/2/2024) when I was at home during the afternoon and worked on the project for a few hours more.


## What could be better

- The search pipeline could be improved with more filters and a better way to handle the query building
- The tests could be improved with more edge cases
- The code could be improved with better validation



