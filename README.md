# Onlinekommentar
Publishing platform for legal commentaries

## How to Set Up

### Prerequisites
- Install Docker Desktop

### Run the Application Locally
- Clone this repository: `git clone git@github.com:textandbytes/onlinekommentar.git`
- cd into the project directory: `cd onlinekommentar`
- Copy the `.env.example` file in `sources/webapp` and name it `.env`, update it with application-specific configuration variables
- cd into the webapp directory: `cd sources/webapp`
- Start the application using Docker: `docker-compose up`
- Install dependencies with composer: `docker-compose run --rm composer install`
- Install frontend dependencies: `docker-compose run --rm npm install`
- Run the database migrations: `docker-compose run --rm artisan migrate`
- Go to http://localhost:8001 and click on "GENERATE APP KEY" (the key will be stored in your `.env` file)

---

## Local Development
- cd into the webapp directory : `cd sources/webapp` and run `composer`, `npm` and `artisan` commands via their Docker containers. See examples below.

### Watching Javascript and CSS changes
- Watch local file changes (JS, CSS): `docker-compose run --rm npm run watch`

### Running npm Commands
- `docker-compose run --rm npm <command>`, e.g. `docker-compose run --rm npm install`

### Running artisan Commands
- `docker-compose run --rm artisan <command>`, e.g. `docker-compose run --rm artisan config:clear`

### Running composer Commands
- `docker-compose run --rm composer require <dependency>`, e.g. `docker-compose run --rm composer require laravel/jetstream`